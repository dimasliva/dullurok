<?php
require_once("models/Database.php");

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

    public function __construct()
    {
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

    // Добавляем сеттер для id и createdAt
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function setCreatedAt(string $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    // Функция для получения курса из базы данных
    public function getCourse(int $id): ?CourseInterface
    {
        $mysqli = Database::getConnection();
        $sql = "SELECT * FROM courses WHERE id=?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($row = $result->fetch_assoc()) {
            $course = new CourseModel();
            // Устанавливаем значения с помощью сеттеров
            $course->setId($row['id']);
            $course->setCourseName($row['course_name']);
            $course->setDescription($row['description']);
            $course->setCreatedAt($row['created_at']);

            return $course; // Возвращаем объект курса
        }

        return null; // Если курс не найден
    }

    // Функция для создания нового курса
    public function createCourse(string $courseName, ?string $description): int
    {
        $mysqli = Database::getConnection();
        $sql = "INSERT INTO courses (course_name, description) VALUES (?, ?)";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("ss", $courseName, $description);
        $stmt->execute();

        return $mysqli->insert_id; // Возвращает ID нового курса
    }

    // Метод для получения всех курсов
    /**
     * @return CourseModel[] Массив объектов CourseModel
     */
    public static function getAllCourses(): array
    {
        $mysqli = Database::getConnection();
        $sql = "SELECT * FROM courses";
        $result = $mysqli->query($sql);

        $courses = [];
        while ($row = $result->fetch_assoc()) {
            $course = new CourseModel();
            // Устанавливаем значения с помощью сеттеров
            $course->setId($row['id']);
            $course->setCourseName($row['course_name']);
            $course->setDescription($row['description']);
            $course->setCreatedAt($row['created_at']);
            $courses[] = $course; // Добавляем объект CourseModel в массив
        }

        return $courses; // Возвращаем массив объектов CourseModel
    }
}
?>