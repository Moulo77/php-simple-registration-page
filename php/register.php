<?php include('services/database.php') ?>
<!DOCTYPE html>
<html>

<head>
    <title>Inscription</title>
    <link rel="stylesheet" type="text/css" href="assets/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
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
            <div class="hint_title_password">
                <label>Mot de passe</label>
                <span class="hint-icon" id="hintIcon"><i class="fas fa-question-circle"></i></span>
            </div>
            <input type="password" name="password_1" id="password1">
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

    <script>
        const hintIcon = document.getElementById('hintIcon');
        const passwordInput = document.getElementById('password1');

        hintIcon.addEventListener('click', function () {
            alert("Votre mot de passe doit contenir au moins 8 caractères, dont au moins une lettre majuscule, une lettre minuscule, un chiffre et un caractère spécial.");
        });
    </script>
</body>

</html>