<?php
include 'functions.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    if (registerUser($username, $email, $password)) {
        $_SESSION['message'] = "Registration successful! You can now login.";
        header('Location: login.php');
    } else {
        $_SESSION['error'] = "Registration failed. Username or email already exists.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
</head>
<body>
    <h2>Register</h2>
    <?php if (isset($_SESSION['error'])): ?>
        <div><?= $_SESSION['error'] ?></div>
        <?php unset($_SESSION['error']); endif; ?>
    <form method="POST">
        <input type="text" name="username" placeholder="Username" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Register</button>
    </form>
</body>
</html>
