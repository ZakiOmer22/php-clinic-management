<?php
include '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $patient_id = intval($_POST['patient_id'] ?? 0);
    $medicine = $conn->real_escape_string(trim($_POST['medicine'] ?? ''));
    $dosage = $conn->real_escape_string(trim($_POST['dosage'] ?? ''));
    $notes = $conn->real_escape_string(trim($_POST['notes'] ?? ''));
    $prescribed_at = $conn->real_escape_string($_POST['prescribed_at'] ?? '');

    if ($patient_id && $medicine && $prescribed_at) {
        $sql = "INSERT INTO prescriptions (patient_id, medicine, dosage, notes, prescribed_at)
                VALUES ($patient_id, '$medicine', '$dosage', '$notes', '$prescribed_at')";

        if ($conn->query($sql) === TRUE) {
            header("Location: ../pages/prescriptions.php");
            exit;
        } else {
            echo "Error: " . $conn->error;
        }
    } else {
        header("Location: ../pages/add_prescription.php?saved=0");
        exit;
    }
} else {
    header("Location: ../pages/add_prescription.php");
    exit;
}
