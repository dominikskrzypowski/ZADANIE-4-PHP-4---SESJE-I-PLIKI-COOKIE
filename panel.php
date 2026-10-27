<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Panel administratora</title>
</head>
<body>
    <h2>Witaj, <?php echo htmlspecialchars($_SESSION['user']); ?>!</h2>
    <p>Jesteś pomyślnie zalogowany w panelu.</p>
    <br>
    <a href="logout.php">Wyloguj się</a>
</body>
</html>