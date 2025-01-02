<?php
require_once("models/VideoModel.php"); // Подключаем модель для уроков

$videoModel = new VideoModel();
$videos = $videoModel->read();

require_once("templates/tutorials.php");