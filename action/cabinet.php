<?php
require_once("models/RoleModel.php");
require_once("models/CourseModel.php");
require_once("models/UserLessonModel.php");
require_once("models/UserModel.php");


if (!isset($_SESSION['userId'])) {
    echo "<div class='text-danger'>Пожалуйста, войдите в систему</div>";
    return;
}

// Accessing user data from the associative array
$userId = $_SESSION['userId']; // Correctly accessing id as an array
$userModel = new UserModel();
$courseModel = new CourseModel();
$user = $userModel->getUser($userId);

if (!$user) {
    echo "<div class='text-danger'>Пользователь не найден</div>";
    return;
}

// Use getter methods to access user properties
$roleModel = new RoleModel();
$role = $roleModel->getRole($user->getRoleId());
$courseId = $user->getCourseId(); // Assuming $user is an object


if (!$courseId) {
    echo "<div class='text-danger'>Такого курса не существует</div>";
    require_once("templates/cabinet.php");
    return;
}

$course = $courseModel->getCourse($courseId);
$userLessonModel = new UserLessonModel();
$userLessons = $userLessonModel->getUserLessons($user->getId());
$lessons = [];

foreach ($userLessons as $userLesson) {
    $lessonId = $userLesson->getLessonId();
    $lessons[] = $userLesson->getLesson($lessonId); // Получаем объект LessonModel
}

require_once("templates/cabinet.php");
