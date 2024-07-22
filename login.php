<?php
include 'functions.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($user = loginUser($username, $password)) {
        $_SESSION['user'] = $user;
        header('Location: dashboard.php');
    } else {
        $_SESSION['error'] = "Login failed. Invalid username or password.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <?php if (isset($_SESSION['error'])): ?>
        <div><?= $_SESSION['error'] ?></div>
        <?php unset($_SESSION['error']); endif; ?>
    <form method="POST">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Login</button>
    </form>
</body>
</html>
