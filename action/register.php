<?php
function isFieldsEmpty(
    string $email,
    string $username,
    string $password,
    string $repassword
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

    if (count($errors) > 0) {
        require_once("templates/register.php");
        return $errors;
    }
    return [];
}

function isUserExists($mysqli, string $username, string $email)
{
    $sql = "SELECT id FROM users WHERE username=? OR email=?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("ss", $username, $email);
    $stmt->execute();
    $result = $stmt->get_result();

    return $result->num_rows > 0; // Return true if user exists
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email = $mysqli->real_escape_string($_POST['email']);
    $username = $mysqli->real_escape_string($_POST['username']);
    $password = $mysqli->real_escape_string($_POST['password']);
    $repassword = $mysqli->real_escape_string($_POST['repassword']);

    $errors = isFieldsEmpty($email, $username, $password, $repassword);

    if (!empty($errors)) {
        // If there are errors, show the registration form again
        require_once("templates/register.php");
        return;
    }

    // Check if user already exists
    if (isUserExists($mysqli, $username, $email)) {
        $errors[] = "Такой пользователь уже существует"; // Add error message
        require_once("templates/register.php");
        return;
    }

    $password = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO users (email, username, password) values (?,?,?)";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('sss', $email, $username, $password);
    $stmt->execute();

    $sql = "SELECT id from users where username=?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();

    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    session_regenerate_id();
    $_SESSION["loggedin"] = TRUE;
    $_SESSION["username"] = $username;
    $_SESSION["userId"] = $user["id"];

    header("Location: " . CABINET_PAGE['url']);

}





require_once("templates/register.php");