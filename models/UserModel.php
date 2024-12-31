<?php
require_once("models/Database.php");

// Определяем интерфейс User
interface UserInterface
{
    public function getId(): int;
    public function getEmail(): string;
    public function getUsername(): string;
    public function getPassword(): string;
    public function getRoleId(): ?int;
    public function getCourseId(): ?int;
    public function getCreatedAt(): string;

    public function setEmail(string $email): void;
    public function setUsername(string $username): void;
    public function setPassword(string $password): void;
    public function setRoleId(?int $roleId): void;
    public function setCourseId(?int $courseId): void;
    public function setCreatedAt(string $createdAt): void;

    public function isUserExists(string $username, ?string $email = null): bool; // Обновленный метод
    public function loginUser(string $username, string $password): bool; // Добавленный метод

    public function createUser(string $email, string $username, string $password, int $roleId, int $courseId): bool;
}

class UserModel implements UserInterface
{
    private int $id;
    private string $email;
    private string $username;
    private string $password;
    private ?int $roleId;
    private ?int $courseId;
    private string $createdAt;

    public function __construct()
    {
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getRoleId(): ?int
    {
        return $this->roleId;
    }

    public function getCourseId(): ?int
    {
        return $this->courseId;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function setRoleId(?int $roleId): void
    {
        $this->roleId = $roleId;
    }

    public function setCourseId(?int $courseId): void
    {
        $this->courseId = $courseId;
    }

    public function setCreatedAt(string $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    public function getUser(int $id): ?UserModel
    {
        $mysqli = Database::getConnection();
        $sql = "SELECT * FROM users WHERE id=?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($row = $result->fetch_assoc()) {
            $user = new UserModel();
            $user->setEmail($row['email']);
            $user->setUsername($row['username']);
            $user->setPassword($row['password']);
            $user->setRoleId($row['role_id']);
            $user->setCourseId($row['course_id']);
            $user->setCreatedAt($row['created_at']);
            $user->id = $row['id'];
            return $user;
        }
        return null;
    }

    public function getUserByUsername(string $username): ?UserModel
    {
        $mysqli = Database::getConnection();
        $sql = "SELECT * FROM users WHERE username=?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($row = $result->fetch_assoc()) {
            $user = new UserModel();
            $user->setEmail($row['email']);
            $user->setUsername($row['username']);
            $user->setPassword($row['password']);
            $user->setRoleId($row['role_id']);
            $user->setCourseId($row['course_id']);
            $user->setCreatedAt($row['created_at']);
            $user->id = $row['id'];
            return $user;
        }
        return null;
    }

    /**
     * @return UserModel[] Массив объектов CourseModel
     */
    public static function getAllUsers(): array
    {
        $mysqli = Database::getConnection();
        $sql = "SELECT * FROM users";
        $result = $mysqli->query($sql);
        $users = [];
        while ($row = $result->fetch_assoc()) {
            $user = new UserModel();
            $user->setEmail($row['email']);
            $user->setUsername($row['username']);
            $user->setPassword($row['password']);
            $user->setRoleId($row['role_id']);
            $user->setCourseId($row['course_id']);
            $user->setCreatedAt($row['created_at']);
            $user->id = $row['id'];
            $users[] = $user;
        }
        return $users;
    }

    public function createUser(string $email, string $username, string $password, int $roleId, int $courseId): bool
    {
        $mysqli = Database::getConnection();
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Обновленный SQL-запрос для вставки с учетом новых колонок
        $sql = "INSERT INTO users (email, username, password, role_id, course_id, created_at) VALUES (?, ?, ?, ?, ?, NOW())";
        $stmt = $mysqli->prepare($sql);

        if ($stmt === false) {
            return false; // Ошибка подготовки запроса
        }

        // Привязываем параметры
        // 'ssiii' - s для строк (email, username, hashedPassword) и i для целых чисел (roleId, courseId)
        $stmt->bind_param('sssii', $email, $username, $hashedPassword, $roleId, $courseId);
        $success = $stmt->execute();
        $stmt->close();

        return $success; // Возвращаем результат выполнения
    }



    public function isUserExists(string $username, ?string $email = null): bool // Обновленная реализация метода
    {
        $mysqli = Database::getConnection();
        if ($email === null) {
            // Если email не передан, ищем только по username
            $sql = "SELECT COUNT(*) FROM users WHERE username=?";
            $stmt = $mysqli->prepare($sql);
            $stmt->bind_param("s", $username);
        } else {
            // Если email передан, ищем по username или email
            $sql = "SELECT COUNT(*) FROM users WHERE username=? OR email=?";
            $stmt = $mysqli->prepare($sql);
            $stmt->bind_param("ss", $username, $email);
        }

        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();
        $stmt->close();

        return $count > 0; // Возвращает true, если пользователь существует
    }

    public function loginUser(string $username, string $password): bool
    {
        $mysqli = Database::getConnection();

        // Запрашиваем пользователя по имени пользователя
        $sql = "SELECT * FROM users WHERE username=?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($row = $result->fetch_assoc()) {
            // Проверяем пароль
            if (password_verify($password, $row['password'])) {
                session_regenerate_id();

                // Успешная аутентификация
                $_SESSION["loggedin"] = TRUE;
                $_SESSION["userId"] = $row['id'];
                $_SESSION["username"] = $row['username'];
                $_SESSION["userRoleId"] = $row['role_id'];

                return true; // Успешный вход
            }
        }

        return false; // Неверное имя пользователя или пароль
    }
}
