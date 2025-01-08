<?php

require_once("models/UserModel.php");

// Обработка URL /checkout с параметрами
$urlComponents = parse_url($requestUri);
parse_str($urlComponents['query'], $queryParams);

$price = 0;
$paymentMethod = null; // Переменная для хранения метода оплаты

if (isset($queryParams["price"])) {
    $price = $queryParams["price"];
}

if (isset($queryParams["payment"])) {
    $paymentMethod = $queryParams["payment"]; // Получаем значение параметра payment
}

// Теперь вы можете использовать переменные $price и $paymentMethod
require_once("templates/payment.php");
