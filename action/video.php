<?php
require_once("models/VideoModel.php"); // Подключаем модель для уроков
$requestUri = $_SERVER['REQUEST_URI'];
if (preg_match('/^\/video\/(\d+)$/', $requestUri, $matches)) {

    $id = $matches[1];
    $lessonModel = new VideoModel();
    $video = $lessonModel->readOne($id);
}
require_once("templates/video.php");