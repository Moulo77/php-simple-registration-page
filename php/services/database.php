<?php
session_start();

$username = "";
$errors = array();

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
    }
    if ($password_1 != $password_2) {
        array_push($errors, "Les mots de passe ne correspondent pas");
    }

    $user_check_query = "SELECT * FROM users WHERE username='$username' LIMIT 1";
    $result = mysqli_query($db, $user_check_query);
    $user = mysqli_fetch_assoc($result);

    if ($user) {
        if ($user['username'] === $username) {
            array_push($errors, "Ce pseudo est déjà utilisé, veuillez en choisir un différent");
        }
    }

    if (count($errors) == 0) {
        $password = md5($password_1);

        $query = "INSERT INTO users (username, password) 
                          VALUES('$username', '$password')";
        mysqli_query($db, $query);
        $_SESSION['username'] = $username;
        $_SESSION['success'] = "Vous êtes maintenant connecté";
        header('location: index.php');
    }
}