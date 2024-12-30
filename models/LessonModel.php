<?php
require_once("models/Database.php");

// Определяем интерфейс LessonInterface
interface LessonInterface
{
    public function getId(): int;
    public function getFile(): ?string;
    public function getVideo(): ?string;
    public function getCreatedAt(): string;

    public function setFile(?string $file): void;
    public function setVideo(?string $video): void;


}

// Реализация интерфейса LessonModel
class LessonModel implements LessonInterface
{
    private int $id;
    private ?string $file;
    private ?string $video;
    private string $createdAt;

    public function __construct(int $id = 0, ?string $file = null, ?string $video = null, string $createdAt = "")
    {
        $this->id = $id;
        $this->file = $file;
        $this->video = $video;
        $this->createdAt = $createdAt;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getFile(): ?string
    {
        return $this->file;
    }

    public function getVideo(): ?string
    {
        return $this->video;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    public function setFile(?string $file): void
    {
        $this->file = $file;
    }

    public function setVideo(?string $video): void
    {
        $this->video = $video;
    }


}
// Метод для создания нового урока
function createLesson(?string $file, ?string $video): bool
{
    $mysqli = Database::getConnection(); // Получаем соединение с базой данных

    $sql = "INSERT INTO lessons (file, video) VALUES (?, ?)";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("ss", $file, $video); // 'ss' означает, что оба параметра - строки

    return $stmt->execute(); // Возвращаем результат выполнения запроса
}
// Функция для получения урока из базы данных
function getLesson(int $id): ?LessonInterface
{
    $mysqli = Database::getConnection(); // Получаем соединение с базой данных

    $sql = "SELECT * FROM lessons WHERE id=?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        return new LessonModel(
            $row['id'],
            $row['file'],
            $row['video'],
            $row['created_at']
        );
    }

    return null; // Если урок не найден
}
