<?php
require_once("models/LessonModel.php"); // Подключаем модель для уроков
$requestUri = $_SERVER['REQUEST_URI'];
if (preg_match('/^\/lesson\/video\/(\d+)$/', $requestUri, $matches)) {

    $lessonId = $matches[1];
    $lessonModel = new LessonModel();
    $lesson = $lessonModel->getLesson($lessonId);
}
require_once("templates/lesson_video.php");