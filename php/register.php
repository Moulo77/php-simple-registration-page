<?php include('services/database.php') ?>
<!DOCTYPE html>
<html>

<head>
    <title>Inscription</title>
    <link rel="stylesheet" type="text/css" href="assets/style.css">
</head>

<body>
    <div class="header">
        <h2>Inscription</h2>
    </div>

    <form method="post" action="register.php">
        <?php include('services/errors.php'); ?>
        <div class="input-group">
            <label>Pseudo</label>
            <input type="text" name="username" value="<?php echo $username; ?>">
        </div>
        <div class="input-group">
            <label>Mot de passe</label>
            <input type="password" name="password_1">
        </div>
        <div class="input-group">
            <label>Confirmer le mot de passe</label>
            <input type="password" name="password_2">
        </div>
        <div class="input-group">
            <button type="submit" class="btn" name="reg_user">S'inscrire</button>
        </div>
        <p>
            Déjà inscrit ? <a href="login.php">Se connecter</a>
        </p>
    </form>
</body>

</html>