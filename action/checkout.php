<?php

require_once("models/UserModel.php");

// Обработка URL /checkout с параметрами
$urlComponents = parse_url($requestUri);
parse_str($urlComponents['query'], $queryParams);
$price = 0;
if (isset($queryParams["price"])) {
    $price = $queryParams["price"];
}

// Capture the payment method after form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $payment = $_POST['payment'] ?? '';
    // Now you can use $payment as needed, e.g., redirect to the payment page
    header("Location: " . PAYMENT_PAGE['url'] . "?price=$price&payment=$payment");
    exit;
}
require_once("templates/checkout.php");