<?php
session_start();
include '../includes/db.php';  // Good path

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if (empty($username) || empty($password)) {
        $_SESSION['login_error'] = "Please enter both username and password.";
        header("Location: ../pages/login.php");  // fixed path
        exit();
    }

    $stmt = $conn->prepare("SELECT id, username, password, role FROM users WHERE username = ?");
    if (!$stmt) {
        die("Prepare failed: (" . $conn->errno . ") " . $conn->error);
    }

    $stmt->bind_param("s", $username);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        if ($password === $user['password']) {  // plaintext password check
            $_SESSION['logged_in'] = true;
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];

            header("Location: ../pages/dashboard.php");  // fixed path
            exit();
        } else {
            $_SESSION['login_error'] = "Invalid username or password.";
            header("Location: ../pages/login.php");  // fixed path
            exit();
        }
    } else {
        $_SESSION['login_error'] = "Invalid username or password.";
        header("Location: ../pages/login.php");  // fixed path
        exit();
    }
} else {
    header("Location: ../pages/login.php");  // fixed path
    exit();
}
?>