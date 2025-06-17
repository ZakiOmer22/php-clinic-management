<?php
include '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $role     = $_POST['role'] ?? '';

    $sql = "INSERT INTO users (username, password, role)
            VALUES ('$username', '$password', '$role')";

    if (mysqli_query($conn, $sql)) {
        header("Location: ../pages/users.php");
        exit;
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    header("Location: ../pages/add_user.php");
    exit;
}
?>
