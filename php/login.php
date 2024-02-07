<?php include('services/database.php') ?>
<!DOCTYPE html>
<html>

<head>
    <title>Connexion</title>
    <link rel="stylesheet" type="text/css" href="assets/style.css">
</head>

<body>
    <div class="header">
        <h2>Connexion</h2>
    </div>

    <form method="post" action="login.php">
        <?php include('services/errors.php'); ?>
        <div class="input-group">
            <label>Pseudo</label>
            <input type="text" name="username">
        </div>
        <div class="input-group">
            <label>Mot de passe </label>
            <input type="password" name="password">
        </div>
        <div class="input-group">
            <button type="submit" class="btn" name="login_user">Se connecter</button>
        </div>
        <p>
            Pas encore de compte? <a href="register.php">S'inscrire</a>
        </p>
    </form>
</body>

</html>