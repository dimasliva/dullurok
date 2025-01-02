<?php
require_once("models/UserModel.php"); // Предполагаем, что у вас есть модель для пользователей
require_once("models/LessonModel.php"); // Подключаем модель для уроков


$users = UserModel::getAllUsers();
$lessons = LessonModel::getAllLessons();
$lessonModel = new LessonModel();
$postMethod = $_SERVER['REQUEST_METHOD'] === 'POST';
if ($postMethod) {
    if (isset($_POST['submit'])) {
        $file = $_FILES['file'] ?? null; // Получаем файл из формы
        $video = $_POST['video'] ?? null; // Получаем видео из формы
        $userId = intval($_POST['user_id']); // Получаем ID пользователя

        // Создаем новый урок и получаем его ID
        $lessonId = $lessonModel->createLesson($file, $video, $userId);

        // Проверяем, был ли урок успешно создан
        if ($lessonId === null) {
            echo "<p class='text-red-500'>Ошибка при создании урока.</p>";
        }
    } else if (isset($_POST['delete'])) {
        $lessonIdToDelete = $_POST['deleteID'];
        if ($lessonModel->deleteLesson($lessonIdToDelete)) {
            header("Location:" . ADMIN_LESSON_PAGE['url']);
        } else {
            echo "Ошибка при удалении урока.";
        }
    } else if (isset($_POST['edit'])) {
        $id = $_POST['edit_lesson_id'];
        $video = $_POST['edit_video'];
        $file = $_FILES['edit_file'] ?? null; // Получаем файл из формы
        $lessonModel->updateLesson($id, $file, $video);
        header("Location:" . ADMIN_LESSON_PAGE['url']);
    }

}


require_once("templates/admin/lesson.php");