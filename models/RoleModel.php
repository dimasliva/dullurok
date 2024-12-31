<?php

// Определяем интерфейс RoleInterface
interface RoleInterface
{
    public function getId(): int;
    public function getRoleName(): string;

    public function setRoleName(string $roleName): void;
    public function setId(int $id): void; // Добавлен метод для установки ID
}

// Реализация интерфейса RoleModel
class RoleModel implements RoleInterface
{
    private int $id;
    private string $roleName;

    public function __construct()
    {

    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getRoleName(): string
    {
        return $this->roleName;
    }

    public function setRoleName(string $roleName): void
    {
        $this->roleName = $roleName;
    }

    public function setId(int $id): void // Метод для установки ID
    {
        $this->id = $id;
    }

    public function getRole($role_id): RoleModel|null
    {
        $mysqli = Database::getConnection();

        $sql = "SELECT * from roles where id=?";
        $stmp = $mysqli->prepare($sql);
        $stmp->bind_param("i", $role_id);
        $stmp->execute();
        $result = $stmp->get_result();
        if ($row = $result->fetch_assoc()) {
            $role = new RoleModel();
            $role->setRoleName($row['role_name']);
            $role->setId($row['id']); // Используем сеттер для установки ID

            return $role;
        }
        return null;
    }

    // Метод для получения всех курсов
    /**
     * @return RoleModel[] Массив объектов CourseModel
     */
    public static function getAllRoles(): array // Метод для получения всех ролей
    {
        $mysqli = Database::getConnection();
        $sql = "SELECT * FROM roles";
        $result = $mysqli->query($sql);

        $roles = [];
        while ($row = $result->fetch_assoc()) {
            $role = new RoleModel();
            $role->setRoleName($row['role_name']);
            $role->setId($row['id']);
            $roles[] = $role; // Добавляем объект RoleModel в массив
        }

        return $roles; // Возвращаем массив объектов RoleModel
    }
}
