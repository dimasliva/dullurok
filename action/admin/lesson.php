<?php
require_once("models/UserModel.php"); // Предполагаем, что у вас есть модель для пользователей
require_once("models/LessonModel.php"); // Подключаем модель для уроков
require_once("models/UserLessonModel.php"); // Подключаем модель для уроков


$users = getAllUsers(); // Метод получения всех пользователей

// Проверяем, была ли отправлена форма
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $file = $_POST['file'] ?? null; // Получаем файл из формы
    $video = $_POST['video'] ?? null; // Получаем видео из формы
    $userId = intval($_POST['user_id']); // Получаем ID пользователя

    // Создаем экземпляр модели уроков
    $lessonModel = new LessonModel();

    // Создаем новый урок
    if (createLesson($file, $video)) {
        // Получаем ID созданного урока
        $lessonId = $lessonModel->getId(); // Предполагаем, что у вас есть метод для получения последнего ID

        // Связываем пользователя с уроком
        if (linkUserToLesson($userId, $lessonId)) {
            echo "<p class='text-green-500'>Урок успешно создан и связан с пользователем!</p>";
        } else {
            echo "<p class='text-red-500'>Урок создан, но ошибка при связывании с пользователем.</p>";
        }
    } else {
        echo "<p class='text-red-500'>Ошибка при создании урока. Пожалуйста, попробуйте еще раз.</p>";
    }
}
require_once("templates/admin/lesson.php");