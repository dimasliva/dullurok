<?php
require_once("models/UserModel.php");
require_once("models/EventModel.php");

$userModel = new UserModel();
$users = UserModel::getAllUsers();
$eventModel = new EventModel();
$events = $eventModel->getAllEvents();

$eventsWithUsernames = [];

foreach ($events as $event) {
    $user = $userModel->getUser($event->getUserId()); // Получаем объект пользователя по user_id
    $event->setData(['username' => $user ? $user->getUsername() : 'Неизвестный пользователь']); // Устанавливаем имя пользователя
    $eventsWithUsernames[] = $event; // Сохраняем событие с добавленным именем пользователя
}


// Проверяем, была ли отправлена форма
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['submit'])) {
        // Получаем данные из формы
        $userId = intval($_POST['user_id']);
        $eventDate = $_POST['event_date'];
        $description = $_POST['description'];

        // Вызываем метод createEvent
        if ($eventModel->createEvent($userId, $description, $eventDate)) {
            echo "<p class='text-green-500'>Событие успешно создано!</p>";
        } else {
            echo "<p class='text-red-500'>Ошибка при создании события. Пожалуйста, попробуйте еще раз.</p>";
        }
    }
    // Обработка удаления события
    if (isset($_POST['delete'])) {
        $eventId = intval($_POST['event_id']);
        if ($eventModel->deleteEvent($eventId)) {
            echo "<p class='text-green-500'>Событие успешно удалено!</p>";
        } else {
            echo "<p class='text-red-500'>Ошибка при удалении события. Пожалуйста, попробуйте еще раз.</p>";
        }
    }

    if (isset($_POST['update'])) {
        $eventId = intval($_POST['event_id']);
        $userId = intval($_POST['user_id']);
        $eventDate = $_POST['event_date'];
        $description = $_POST['description'];

        if ($eventModel->updateEvent($eventId, $userId, $description, $eventDate)) {
            echo "<p class='text-green-500'>Событие успешно обновлено!</p>";
        } else {
            echo "<p class='text-red-500'>Ошибка при обновлении события. Пожалуйста, попробуйте еще раз.</p>";
        }
    }
}

require_once("templates/admin/events.php");
