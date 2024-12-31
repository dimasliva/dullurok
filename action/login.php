<?php

require_once("models/UserModel.php");
require_once("models/Database.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $mysqli = Database::getConnection();
    $username = $mysqli->real_escape_string($_POST['username']);
    $password = $mysqli->real_escape_string($_POST['password']);

    $userModel = new UserModel();

    $errors = [];
    if (!$userModel->loginUser($username, $password)) {
        $errors[] = "Такого пользователя не существует";
        require_once("templates/login.php");
        return;
    }
    $errors = [];
    header("Location:" . CABINET_PAGE['url']);

}


require_once("templates/login.php");