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

    public function __construct(int $userId, int $lessonId)
    {
        $this->userId = $userId;
        $this->lessonId = $lessonId;
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
    public function getLesson(): ?LessonModel
    {
        return getLesson($this->lessonId); // Используем существующую функцию
    }


}

// Функция для получения уроков пользователя
function getUserLessons(int $userId): array
{
    $mysqli = Database::getConnection(); // Получаем соединение с базой данных

    $sql = "SELECT lesson_id FROM user_lessons WHERE user_id = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();

    $userLessons = [];
    while ($row = $result->fetch_assoc()) {
        $userLessons[] = new UserLessonModel($userId, $row['lesson_id']); // Создаем объект UserLessonModel
    }

    return $userLessons; // Возвращает массив объектов UserLessonModel
}
// Метод для связывания пользователя с уроком
function linkUserToLesson(int $userId, int $lessonId): bool
{
    $mysqli = Database::getConnection(); // Получаем соединение с базой данных

    $sql = "INSERT INTO user_lessons (user_id, lesson_id) VALUES (?, ?)";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("ii", $userId, $lessonId); // 'ii' означает, что оба параметра - целые числа

    return $stmt->execute(); // Возвращаем результат выполнения запроса
}
?>