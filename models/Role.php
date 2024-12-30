<?php

// Определяем интерфейс RoleInterface
interface RoleInterface
{
    public function getId(): int;
    public function getRoleName(): string;

    public function setRoleName(string $roleName): void;
}

// Реализация интерфейса RoleModel
class RoleModel implements RoleInterface
{
    private int $id;
    private string $roleName;

    public function __construct(int $id, string $roleName)
    {
        $this->id = $id;
        $this->roleName = $roleName;
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
}

function getRole(mysqli $mysqli, $role_id): RoleModel|null
{
    $sql = "SELECT * from roles where id=?";
    $stmp = $mysqli->prepare($sql);
    $stmp->bind_param("i", $role_id);
    $stmp->execute();
    $result = $stmp->get_result();
    if ($row = $result->fetch_assoc()) {
        $role = new RoleModel(
            $row['id'],
            $row['role_name'],
        );
        return $role;
    }
    return null;
}