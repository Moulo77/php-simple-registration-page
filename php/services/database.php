<?php
session_start();

$username = "";
$errors = array();

define('MAX_LOGIN_ATTEMPTS', '5');

$db = mysqli_connect('db', 'admin', 'admin', 'db');

if (isset($_POST['reg_user'])) {
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
    $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

    if (empty($username)) {
        array_push($errors, "Veuillez renseigner un pseudo");
    }
    if (empty($password_1)) {
        array_push($errors, "Un mot de passe est requis");
    } elseif (strlen($password_1) < 8) {
        array_push($errors, "Le mot de passe doit comporter au moins 8 caractères");
    } elseif (!preg_match("/[a-z]/", $password_1)) {
        array_push($errors, "Le mot de passe doit contenir au moins une lettre minuscule");
    } elseif (!preg_match("/[A-Z]/", $password_1)) {
        array_push($errors, "Le mot de passe doit contenir au moins une lettre majuscule");
    } elseif (!preg_match("/[0-9]/", $password_1)) {
        array_push($errors, "Le mot de passe doit contenir au moins un chiffre");
    } elseif (!preg_match("/[?!@#$%^&*()\-_=+{};:,<.>]/", $password_1)) {
        array_push($errors, "Le mot de passe doit contenir au moins un caractère spécial");
    }

    if ($password_1 != $password_2) {
        array_push($errors, "Les mots de passe ne correspondent pas");
    }

    $stmt = mysqli_prepare($db, "SELECT * FROM users WHERE username=? LIMIT 1");
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);

    if (mysqli_stmt_num_rows($stmt) > 0) {
        array_push($errors, "Ce pseudo est déjà utilisé, veuillez en choisir un différent");
    }

    mysqli_stmt_close($stmt);

    if (count($errors) == 0) {
        $password = password_hash($password_1, PASSWORD_DEFAULT);

        $stmt = mysqli_prepare($db, "INSERT INTO users (username, password) VALUES(?, ?)");
        mysqli_stmt_bind_param($stmt, "ss", $username, $password);
        mysqli_stmt_execute($stmt);

        $_SESSION['username'] = $username;
        $_SESSION['success'] = "Vous êtes maintenant connecté";
        header('location: index.php');
    }
}

if (isset($_POST['login_user'])) {
    if (isset($_SESSION['login_attempts']) && $_SESSION['login_attempts'] >= MAX_LOGIN_ATTEMPTS) {
        array_push($errors, 'Vous avez atteint le nombre maximum d\'essais autorisés !');
    }

    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password = mysqli_real_escape_string($db, $_POST['password']);

    if (empty($username)) {
        array_push($errors, "Un pseudo est requis");
    }
    if (empty($password)) {
        array_push($errors, "Un mot de passe est requis");
    }

    if (count($errors) == 0) {
        $stmt = mysqli_prepare($db, "SELECT username, password FROM users WHERE username=?");
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $db_username, $db_password);
        mysqli_stmt_fetch($stmt);

        if (password_verify($password, $db_password)) {
            $_SESSION['username'] = $db_username;
            $_SESSION['success'] = "Vous êtes connecté";
            unset($_SESSION["login_attempts"]);
            header('location: index.php');
        } else {
            $remaining_attempts = isset($_SESSION['login_attempts']) ? MAX_LOGIN_ATTEMPTS - $_SESSION['login_attempts'] : MAX_LOGIN_ATTEMPTS;
            $_SESSION['login_attempts'] = isset($_SESSION['login_attempts']) ? $_SESSION['login_attempts'] + 1 : 1;
            array_push($errors, "Mot de passe ou pseudo incorrect. Il vous reste " . $remaining_attempts . " tentative(s) de connexion.");
        }

        mysqli_stmt_close($stmt);
    }
}

?>