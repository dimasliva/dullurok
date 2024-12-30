<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $mysqli->real_escape_string($_POST['username']);
    $password = $mysqli->real_escape_string($_POST['password']);

    $sql = "SELECT id, password from users where username=?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('s', $username);
    $stmt->execute();

    $result = $stmt->get_result();
    $errors = [];
    if ($result->num_rows === 0) {
        $errors[] = "Такого пользователя не существует";
        require_once("templates/login.php");
        return;
    }
    $errors = [];
    $user = $result->fetch_assoc();
    // if (!password_verify($password, $user['password'])) {
    //     $errors[] = "Неверный пароль";
    //     require_once("templates/login.php");
    //     return;
    // }
    session_regenerate_id();
    $_SESSION["loggedin"] = TRUE;
    $_SESSION["username"] = $username;
    $_SESSION["userId"] = $user["id"];
    header("Location:" . CABINET_PAGE['url']);
}


require_once("templates/login.php");