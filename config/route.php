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
} elseif ($requestUri === ADMIN_EVENTS_PAGE['url']) {
    require_once(ADMIN_EVENTS_PAGE['file']);
} elseif ($requestUri === ADMIN_LESSON_PAGE['url']) {
    require_once(ADMIN_LESSON_PAGE['file']);
} elseif ($requestUri === ADMIN_PAGE['url']) {
    require_once(ADMIN_PAGE['file']);
} elseif ($requestUri === DONATION_PAGE['url']) {
    require_once(DONATION_PAGE['file']);
} elseif (preg_match('/^\/lesson\/video\/(\d+)$/', $requestUri, $matches)) {
    require_once(LESSON_VIDEO_PAGE['file']);
} elseif (preg_match('/^\/video\/(\d+)$/', $requestUri, $matches)) {
    require_once(VIDEO_PAGE['file']);
} else {
    // Обработка 404 или других случаев
    http_response_code(404);
    echo "Page not found.";
}