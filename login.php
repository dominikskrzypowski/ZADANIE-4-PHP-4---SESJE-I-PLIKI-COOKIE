<?php
session_start();

if (isset($_SESSION['user'])) {
    header("Location: panel.php");
    exit;
}

$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = $_POST['login'] ?? '';
    $password = $_POST['password'] ?? '';
    $remember = isset($_POST['remember']);

    if ($login === 'admin' && $password === '1234') {
        $_SESSION['user'] = $login;

        if ($remember) {
            setcookie('saved_login', $login, time() + (7 * 24 * 60 * 60), "/");
        } else {
            if (isset($_COOKIE['saved_login'])) {
                setcookie('saved_login', '', time() - 3600, "/");
            }
        }

        header("Location: panel.php");
        exit;
    } else {
        $error = "Błędny login lub hasło!";
    }
}

$cookie_login = isset($_COOKIE['saved_login']) ? $_COOKIE['saved_login'] : '';
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Logowanie</title>
</head>
<body>
    <h2>Formularz logowania</h2>

    <?php if (!empty($error)): ?>
        <p style="color: red;"><?php echo htmlspecialchars($error); ?></p>
    <?php endif; ?>

    <form action="login.php" method="POST">
        <div>
            <label for="login">Login:</label><br>
            <input type="text" id="login" name="login" value="<?php echo htmlspecialchars($cookie_login); ?>" required>
        </div>
        <br>
        <div>
            <label for="password">Hasło:</label><br>
            <input type="password" id="password" name="password" required>
        </div>
        <br>
        <div>
            <input type="checkbox" id="remember" name="remember" <?php echo !empty($cookie_login) ? 'checked' : ''; ?>>
            <label for="remember">Zapamiętaj mnie</label>
        </div>
        <br>
        <div>
            <button type="submit">Zaloguj się</button>
        </div>
    </form>
</body>
</html>