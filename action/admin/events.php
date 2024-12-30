<?php
require_once("models/UserModel.php");
require_once("models/EventModel.php");

$users = getAllUsers();

// Проверяем, была ли отправлена форма
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    // Получаем данные из формы
    $userId = intval($_POST['user_id']);
    $eventDate = $_POST['event_date'];
    $description = $_POST['description'];

    // Создаем экземпляр модели событий
    $eventModel = new EventModel();

    // Вызываем метод createEvent
    if ($eventModel->createEvent($userId, $description, $eventDate)) {
        echo "<p class='text-green-500'>Событие успешно создано!</p>";
    } else {
        echo "<p class='text-red-500'>Ошибка при создании события. Пожалуйста, попробуйте еще раз.</p>";
    }
}
require_once("templates/admin/events.php");