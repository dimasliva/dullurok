<?php
$env = parse_ini_file(".env");
define("DB_HOST", $env["DB_HOST"]);
define("DB_USER", $env["DB_USER"]);
define("DB_PASS", $env["DB_PASS"]);
define("DB_NAME", $env["DB_NAME"]);

const LOGO_NAME = "DullUrok";
const URL_SITE = "https://dull.local/";
const IMGS_PATH = "/css/images";
const SVGS_PATH = "./css/svgs";
const STYLES_PATH = "/css/styles";

const HOME_PAGE = [
    'url' => '/',
    'name' => 'Главная',
    'file' => 'action/home.php',
];
const TUTORIALS_PAGE = [
    'url' => '/tutorials',
    'name' => 'Уроки',
    'file' => 'action/tutorials.php',
];
const SOCIALS_PAGE = [
    'url' => '/socials',
    'name' => 'Соц.сети',
    'file' => 'action/socials.php',
];
const REGISTER_PAGE = [
    'url' => '/register',
    'name' => 'Регистрация',
    'file' => 'action/register.php',
];
const LOGIN_PAGE = [
    'url' => '/login',
    'name' => 'Вход',
    'file' => 'action/login.php',
];
const CABINET_PAGE = [
    'url' => '/cabinet',
    'name' => 'Личный кабинет',
    'file' => 'action/cabinet.php',
];
const LESSON_VIDEO_PAGE = [
    'url' => '/lesson/video',
    'name' => 'Видео занятия',
    'file' => 'action/lesson_video.php',
];
const VIDEO_PAGE = [
    'url' => '/video',
    'name' => 'Видео урока',
    'file' => 'action/video.php',
];
const ADMIN_PAGE = [
    'url' => '/admin',
    'name' => 'Админ панель',
    'file' => 'action/admin/admin.php',
];
const ADMIN_EVENTS_PAGE = [
    'url' => '/admin/events',
    'name' => 'Заплонировать занятие',
    'file' => 'action/admin/events.php',
];
const ADMIN_LESSON_PAGE = [
    'url' => '/admin/lesson',
    'name' => 'Добавить занятие',
    'file' => 'action/admin/lesson.php',
];
const DONATION_PAGE = [
    'url' => '/donation',
    'name' => 'Пожертвование',
    'file' => 'action/donation.php',
];

?>