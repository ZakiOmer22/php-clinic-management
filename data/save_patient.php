<?php
include '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name   = trim($_POST['name'] ?? '');
    $gender = $_POST['gender'] ?? '';
    $phone  = trim($_POST['phone'] ?? '');
    $email  = trim($_POST['email'] ?? '');

    if ($name && $gender) {
        $stmt = $conn->prepare("INSERT INTO patients (name, gender, phone, email) VALUES (?, ?, ?, ?)");
        if ($stmt === false) {
            die("Prepare failed: " . $conn->error);
        }
        $stmt->bind_param("ssss", $name, $gender, $phone, $email);
        if ($stmt->execute()) {
            header("Location: ../pages/patients.php");
            exit;
        } else {
            header("Location: ../pages/add_patient.php?saved=0");
            exit;
        }
    } else {
        header("Location: ../pages/add_patient.php?saved=0");
        exit;
    }
} else {
    header("Location: ../pages/add_patient.php");
    exit;
}
