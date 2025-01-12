<?php
$requestUri = $_SERVER['REQUEST_URI'];
// Обработка маршрутов
if ($requestUri === REGISTER_PAGE['url']) {
    require_once(REGISTER_PAGE['file']);
} elseif ($requestUri === LOGIN_PAGE['url']) {
    require_once(LOGIN_PAGE['file']);
} elseif ($requestUri === HOME_PAGE['url']) {
    require_once(HOME_PAGE['file']);
} elseif ($requestUri === TUTORIALS_PAGE['url']) {
    require_once(TUTORIALS_PAGE['file']);
} elseif ($requestUri === SOCIALS_PAGE['url']) {
    require_once(SOCIALS_PAGE['file']);
} elseif ($requestUri === CABINET_PAGE['url']) {
    require_once(CABINET_PAGE['file']);
} elseif ($requestUri === CABINET_LESSONS_PAGE['url']) {
    require_once(CABINET_LESSONS_PAGE['file']);
} elseif ($requestUri === ADMIN_EVENTS_PAGE['url']) {
    require_once(ADMIN_EVENTS_PAGE['file']);
} elseif ($requestUri === ADMIN_LESSON_PAGE['url']) {
    require_once(ADMIN_LESSON_PAGE['file']);
} elseif ($requestUri === ADMIN_PAGE['url']) {
    require_once(ADMIN_PAGE['file']);
} elseif ($requestUri === DONATION_PAGE['url']) {
    require_once(DONATION_PAGE['file']);
} elseif ($requestUri === BUY_LESSON_PAGE['url']) {
    require_once(BUY_LESSON_PAGE['file']);
} elseif (strpos($requestUri, CHECKOUT_PAGE['url']) === 0) {
    // Обработка URL /checkout с параметрами
    $urlComponents = parse_url($requestUri);
    parse_str($urlComponents['query'], $queryParams);
    if (isset($queryParams["price"])) {
        require_once(CHECKOUT_PAGE['file']);
    } else {
        // Если параметр price не передан, можно отобразить сообщение или выполнить другую логику
        echo "Ошибка: параметр price не передан.";
    }
} elseif (strpos($requestUri, PAYMENT_PAGE['url']) === 0) {
    // Обработка URL /checkout с параметрами
    $urlComponents = parse_url($requestUri);
    parse_str($urlComponents['query'], $queryParams);

    // Инициализация переменных
    $price = 0;
    $paymentMethod = null;

    if (!isset($queryParams["price"])) {
        // Если параметр price не передан, выводим сообщение об ошибке
        echo "Ошибка: параметр price не передан.";
        return; // Завершаем выполнение, если price отсутствует
    }
    if (!isset($queryParams["payment"])) {
        // Если параметр payment не передан, можно отобразить сообщение или выполнить другую логику
        http_response_code(404);
        echo "Ошибка: параметр payment не передан.";
    }
    // Если оба параметра переданы, загружаем файл
    require_once(PAYMENT_PAGE['file']);
} elseif (preg_match('/^\/lesson\/video\/(\d+)$/', $requestUri, $matches)) {
    require_once(LESSON_VIDEO_PAGE['file']);
} elseif (preg_match('/^\/video\/(\d+)$/', $requestUri, $matches)) {
    require_once(VIDEO_PAGE['file']);
} else {
    // Обработка 404 или других случаев
    http_response_code(404);
    echo "Page not found.";
}