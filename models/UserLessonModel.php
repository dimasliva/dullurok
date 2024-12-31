<?php
require_once("models/Database.php");
require_once("models/LessonModel.php");

// Интерфейс для работы с записями user_lessons
interface UserLessonInterface
{
    public function getUserId(): int;
    public function getLessonId(): int;
}

// Модель для user_lessons
class UserLessonModel implements UserLessonInterface
{
    private int $userId;
    private int $lessonId;

    // Конструктор без параметров
    public function __construct()
    {
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getLessonId(): int
    {
        return $this->lessonId;
    }

    // Метод для получения объекта LessonModel по lessonId
    public function getLesson(int $lessonId): ?LessonModel
    {
        $mysqli = Database::getConnection(); // Получаем соединение с базой данных

        $sql = "SELECT * FROM lessons WHERE id = ?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("i", $lessonId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($row = $result->fetch_assoc()) {
            // Создаем объект LessonModel и заполняем его данными из базы
            $lesson = new LessonModel();
            $lesson->setId($row['id']);
            $lesson->setVideo($row['video']);
            $lesson->setFile($row['file']);
            $lesson->setCreatedAt($row['created_at']);

            return $lesson; // Возвращаем объект LessonModel
        }

        return null; // Если урока не найдено, возвращаем null
    }

    // Функция для получения уроков пользователя
    public function getUserLessons(int $userId): array
    {
        $mysqli = Database::getConnection(); // Получаем соединение с базой данных

        $sql = "SELECT lesson_id FROM user_lessons WHERE user_id = ?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();

        $userLessons = [];
        while ($row = $result->fetch_assoc()) {
            $lesson = new UserLessonModel(); // Создаем объект UserLessonModel
            $lesson->userId = $userId; // Инициализируем userId
            $lesson->lessonId = $row['lesson_id']; // Инициализируем lessonId
            $userLessons[] = $lesson; // Добавляем объект в массив
        }

        return $userLessons; // Возвращает массив объектов UserLessonModel
    }

    // Метод для связывания пользователя с уроком
    public function linkUserToLesson(int $userId, int $lessonId): bool
    {
        $mysqli = Database::getConnection(); // Получаем соединение с базой данных

        $sql = "INSERT INTO user_lessons (user_id, lesson_id) VALUES (?, ?)";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("ii", $userId, $lessonId); // 'ii' означает, что оба параметра - целые числа

        return $stmt->execute(); // Возвращаем результат выполнения запроса
    }
}
?>