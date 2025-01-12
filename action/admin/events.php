<?php
require_once("models/UserModel.php");
require_once("models/EventModel.php");

$userModel = new UserModel();
$users = UserModel::getAllUsers();
$eventModel = new EventModel();
$events = $eventModel->getAllEvents();

$eventsWithUsernames = [];

foreach ($events as $event) {
    $user = $userModel->getUser($event->getUserId());
    $event->setData(['username' => $user ? $user->getUsername() : 'Неизвестный пользователь']);
    $eventsWithUsernames[] = $event;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['submit'])) {
        $userId = intval($_POST['user_id']);
        $eventDate = $_POST['event_date'];
        $description = $_POST['description'];

        if ($eventModel->createEvent($userId, $description, $eventDate)) {
            header("Location:" . ADMIN_EVENTS_PAGE['url']);
        } else {
            echo "<p class='text-red-500'>Ошибка при создании события. Пожалуйста, попробуйте еще раз.</p>";
        }
    }

    if (isset($_POST['delete'])) {
        $eventId = intval($_POST['event_id']);
        if ($eventModel->deleteEvent($eventId)) {
            header("Location:" . ADMIN_EVENTS_PAGE['url']);
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
            header("Location:" . ADMIN_EVENTS_PAGE['url']);
        } else {
            echo "<p class='text-red-500'>Ошибка при обновлении события. Пожалуйста, попробуйте еще раз.</p>";
        }
    }
}

require_once("templates/admin/events.php");
?>