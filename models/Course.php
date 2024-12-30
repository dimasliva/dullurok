<?php

// Определяем интерфейс CourseInterface
interface CourseInterface
{
    public function getId(): int;
    public function getCourseName(): string;
    public function getDescription(): ?string;
    public function getCreatedAt(): string;

    public function setCourseName(string $courseName): void;
    public function setDescription(?string $description): void;
}

// Реализация интерфейса CourseModel
class CourseModel implements CourseInterface
{
    private int $id;
    private string $courseName;
    private ?string $description;
    private string $createdAt;

    public function __construct(int $id, string $courseName, ?string $description, string $createdAt)
    {
        $this->id = $id;
        $this->courseName = $courseName;
        $this->description = $description;
        $this->createdAt = $createdAt;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getCourseName(): string
    {
        return $this->courseName;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    public function setCourseName(string $courseName): void
    {
        $this->courseName = $courseName;
    }

    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }
}

// Функция для получения курса из базы данных
function getCourse(mysqli $mysqli, int $id): ?CourseInterface
{
    $sql = "SELECT * FROM courses WHERE id=?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        return new CourseModel(
            $row['id'],
            $row['course_name'],
            $row['description'],
            $row['created_at']
        );
    }

    return null; // Если курс не найден
}

// Функция для создания нового курса
function createCourse(mysqli $mysqli, string $courseName, ?string $description): int
{
    $sql = "INSERT INTO courses (course_name, description) VALUES (?, ?)";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("ss", $courseName, $description);
    $stmt->execute();

    return $mysqli->insert_id; // Возвращает ID нового курса
}

?>