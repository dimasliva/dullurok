<?php
require_once("models/EventModel.php");
require_once("models/UserModel.php");

$eventModel = new EventModel();
$date = '';
$userId = $_SESSION['userId'];

// Проверяем, был ли отправлен POST-запрос
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Получаем массив дат из POST-запроса
    if (isset($_POST['dates']) && is_array($_POST['dates'])) {
        $dates = $_POST['dates'];

        // Создаем события для каждой выбранной даты
        foreach ($dates as $date) {
            $eventModel->createEvent($userId, '', $date);
        }
        header("Location:" . CABINET_PAGE['url']);
    } else {
        // Если массив дат не был передан, возвращаем ошибку
        echo 'Ошибка: Даты не переданы.';
    }
}

// Обработка URL /checkout с параметрами
$urlComponents = parse_url($requestUri);
parse_str($urlComponents['query'], $queryParams);

$price = 0;
$paymentMethod = null; // Переменная для хранения метода оплаты

if (isset($queryParams["price"])) {
    $price = intval($queryParams["price"]); // Приводим к целому числу
}

if (isset($queryParams["payment"])) {
    $paymentMethod = $queryParams["payment"]; // Получаем значение параметра payment
}

// Теперь вы можете использовать переменные $price и $paymentMethod
require_once("templates/payment.php");
