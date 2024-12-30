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
}

// Реализация интерфейса User
class UserModel implements UserInterface
{
    private int $id;
    private string $email;
    private string $username;
    private string $password;
    private ?int $roleId;
    private ?int $courseId;
    private string $createdAt;

    public function __construct(int $id, string $email, string $username, string $password, ?int $roleId, ?int $courseId, string $createdAt)
    {
        $this->id = $id;
        $this->email = $email;
        $this->username = $username;
        $this->password = $password;
        $this->roleId = $roleId;
        $this->courseId = $courseId;
        $this->createdAt = $createdAt;
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
}

function getUser(int $id): ?UserModel
{
    $mysqli = Database::getConnection(); // Получаем соединение с базой данных
    $sql = "SELECT * FROM users WHERE id=?";
    $stmp = $mysqli->prepare($sql);
    $stmp->bind_param("i", $id);
    $stmp->execute();
    $result = $stmp->get_result();
    if ($row = $result->fetch_assoc()) {
        return new UserModel(
            $row['id'],
            $row['email'],
            $row['username'],
            $row['password'],
            $row['role_id'],
            $row['course_id'],
            $row['created_at']
        );
    }

    return null; // Если пользователь не найден
}

function getAllUsers(): array
{
    $mysqli = Database::getConnection(); // Получаем соединение с базой данных
    $sql = "SELECT * FROM users";
    $result = $mysqli->query($sql);

    $users = [];
    while ($row = $result->fetch_assoc()) {
        $users[] = new UserModel(
            $row['id'],
            $row['email'],
            $row['username'],
            $row['password'],
            $row['role_id'],
            $row['course_id'],
            $row['created_at']
        );
    }

    return $users; // Возвращаем массив объектов UserModel
}