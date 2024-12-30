<?php
require_once("models/UserLessonModel.php");
$requestUri = $_SERVER['REQUEST_URI'];
if (preg_match('/^\/video\/(\d+)$/', $requestUri, $matches)) {

    $videoId = $matches[1];
    $lesson = getLesson($videoId);
}
require_once("templates/video.php");