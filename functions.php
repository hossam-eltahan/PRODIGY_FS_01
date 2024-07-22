<?php
include 'config.php';

function registerUser($username, $email, $password, $role = 'user') {
    global $pdo;
    $hash = password_hash($password, PASSWORD_BCRYPT);
    try {
        $stmt = $pdo->prepare("INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$username, $email, $hash, $role]);
    } catch (PDOException $e) {
        if ($e->getCode() == 23000) { // Integrity constraint violation
            return false;
        } else {
            throw $e;
        }
    }
}

function loginUser($username, $password) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC); // Ensure fetching as associative array
    if ($user && password_verify($password, $user['password'])) {
        return $user;
    }
    return false;
}

function isLoggedIn() {
    return isset($_SESSION['user']);
}

function getCurrentUser() {
    return $_SESSION['user'] ?? null;
}
?>
