<?php
require_once("models/Database.php");
require_once("models/UserModel.php");
require_once("models/CourseModel.php");
require_once("models/RoleModel.php");



function isFieldsEmpty(
    string $email,
    string $username,
    string $password,
    string $repassword,
    string $name,
    string $surname
) {
    $errors = [];
    if (empty($email)) {
        array_push($errors, "Введите email");
    }

    if (empty($username)) {
        array_push($errors, "Введите username");
    }

    if (empty($password)) {
        array_push($errors, "Введите пароль");
    }

    if (empty($repassword)) {
        array_push($errors, "Введите пароль подтверждения");
    }

    if ($password !== $repassword) {
        array_push($errors, "Пароли не совпадают");
    }

    if (empty($name)) {
        array_push($errors, "Введите имя");
    }

    if (empty($surname)) {
        array_push($errors, "Введите фамилию");
    }

    return $errors;
}


$courses = CourseModel::getAllCourses();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register'])) {
    // Инициализация соединения с базой данных
    $mysqli = Database::getConnection();

    $email = $mysqli->real_escape_string($_POST['email']);
    $username = $mysqli->real_escape_string($_POST['username']);
    $password = $mysqli->real_escape_string($_POST['password']);
    $repassword = $mysqli->real_escape_string($_POST['repassword']);
    $name = $mysqli->real_escape_string($_POST['name']);
    $surname = $mysqli->real_escape_string($_POST['surname']);
    $courseId = (int) $_POST['course_id']; // Приведение к типу int

    $errors = isFieldsEmpty($email, $username, $password, $repassword, $name, $surname);

    if (!empty($errors)) {
        require_once("templates/register.php");
        return;
    }

    $userModel = new UserModel();
    if ($userModel->isUserExists($username, $email)) {
        $errors[] = "Такой пользователь уже существует"; // Add error message
        require_once("templates/register.php");
        return;
    }

    // Обновленный вызов метода createUser  с новыми параметрами
    $regSuccess = $userModel->createUser($email, $username, $password, $name, $surname, $courseId);
    if ($regSuccess) {
        $user = $userModel->getUserByUsername($username);
        if ($user) {
            header("Location: " . CABINET_PAGE['url']);
            $_SESSION["loggedin"] = TRUE;
            $_SESSION["userId"] = $user->getId();
            $_SESSION["username"] = $user->getUsername();
            $_SESSION["userRoleId"] = $user->getRoleId();
            exit(); // Завершение скрипта после редиректа
        } else {
            $errors[] = "Ошибка при входе. Проверьте свои учетные данные.";
        }
    } else {
        $errors[] = "Ошибка при регистрации. Пожалуйста, попробуйте еще раз.";
    }
}


require_once("templates/register.php");
