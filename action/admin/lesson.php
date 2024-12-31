<?php
require_once("models/UserModel.php"); // Предполагаем, что у вас есть модель для пользователей
require_once("models/LessonModel.php"); // Подключаем модель для уроков
require_once("models/UserLessonModel.php"); // Подключаем модель для уроков


$users = UserModel::getAllUsers();
$lessons = LessonModel::getAllLessons();
$lessonModel = new LessonModel();

// Проверяем, была ли отправлена форма
// Проверяем, была ли отправлена форма
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $file = $_FILES['file'] ?? null; // Получаем файл из формы
    $video = $_POST['video'] ?? null; // Получаем видео из формы
    $userId = intval($_POST['user_id']); // Получаем ID пользователя

    // Создаем экземпляр модели уроков
    $userLessonModel = new UserLessonModel();

    // Создаем новый урок и получаем его ID
    $lessonId = $lessonModel->createLesson($file, $video);

    // Проверяем, был ли урок успешно создан
    if ($lessonId !== null) {
        // Связываем пользователя с уроком
        if ($userLessonModel->linkUserToLesson($userId, $lessonId)) {
            echo "<p class='text-green-500'>Урок успешно создан и связан с пользователем!</p>";
        } else {
            echo "<p class='text-red-500'>Урок создан, но ошибка при связывании с пользователем.</p>";
        }
    } else {
        echo "<p class='text-red-500'>Ошибка при создании урока.</p>";
    }
} else if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
    $lessonIdToDelete = $_POST['deleteID'];
    if ($lessonModel->deleteLesson($lessonIdToDelete)) {
        header("Location:" . ADMIN_LESSON_PAGE['url']);
    } else {
        echo "Ошибка при удалении урока.";
    }
}

require_once("templates/admin/lesson.php");