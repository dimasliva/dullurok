<?php
require_once("models/Role.php");
require_once("models/Course.php");
require_once("models/LessonModel.php");
require_once("models/UserLessonModel.php");
require_once("models/UserModel.php");

// Проверка нажатия кнопки "Выйти"
if (isset($_POST['exit'])) {
    session_destroy();
    header("Location:" . LOGIN_PAGE['url']);
}
if (!isset($_SESSION['loggedin'])) {
    header("Location:" . LOGIN_PAGE['url']);
}
$userId = $_SESSION['userId'];
$user = getUser($userId);

$role = getRole($mysqli, $user->getRoleId());
$course = getCourse($mysqli, $user->getCourseId());
$userLessons = getUserLessons($user->getId());
$lessons = [];

foreach ($userLessons as $userLesson) {
    $lessons[] = $userLesson->getLesson(); // Получаем объект LessonModel
}

require_once("templates/cabinet.php");