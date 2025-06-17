<?php
session_start();
include '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if ($username === '' || $password === '') {
        $_SESSION['login_error'] = "Please enter both username and password.";
        header("Location: ../pages/login.php");
        exit();
    }

    $sql = "SELECT id, username, password, role FROM users WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) === 1) {
        $user = mysqli_fetch_assoc($result);
        if ($password === $user['password']) {
            $_SESSION['logged_in'] = true;
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];

            header("Location: ../pages/dashboard.php");
            exit();
        }
    }

    $_SESSION['login_error'] = "Invalid username or password.";
    header("Location: ../pages/login.php");
    exit();
} else {
    header("Location: ../pages/login.php");
    exit();
}
?>
