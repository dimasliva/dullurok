<?php
require_once("models/RoleModel.php");
require_once("models/CourseModel.php");
require_once("models/LessonModel.php");
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
    session_destroy();
    header("Location:" . LOGIN_PAGE['url']);
}


require_once("templates/buy_lesson.php");
