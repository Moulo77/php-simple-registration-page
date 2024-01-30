<?php
$host = 'db';
$user = 'root';
$password = 'root';
$db = 'db';

$conn = new mysqli($host, $user, $password, $db);
if (!$conn) {
    echo "Erreur de connexion à MYSQL<br />";
} else {
    echo "Connexion à MYSQL ok<br />";
    mysqli_close($conn);
}
?>