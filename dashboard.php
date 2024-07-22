<?php
include 'functions.php';
session_start();

if (!isLoggedIn()) {
    header('Location: login.php');
    exit;
}

$user = getCurrentUser();

if (!is_array($user)) {
    echo "User data is not in the correct format.";
    var_dump($user); // Debugging output
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>
    <h2>Welcome, <?= htmlspecialchars($user['username']) ?></h2>
    <a href="logout.php">Logout</a>
</body>
</html>
