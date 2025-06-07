<?php
include '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $patient_id = intval($_POST['patient_id'] ?? 0);
    $medicine = $conn->real_escape_string(trim($_POST['medicine'] ?? ''));
    $dosage = $conn->real_escape_string(trim($_POST['dosage'] ?? ''));
    $notes = $conn->real_escape_string(trim($_POST['notes'] ?? ''));
    $prescribed_at = $conn->real_escape_string($_POST['prescribed_at'] ?? '');

    // Basic validation: patient_id, medicine, prescribed_at required
    if ($patient_id && $medicine && $prescribed_at) {
        $sql = "INSERT INTO prescriptions (patient_id, medicine, dosage, notes, prescribed_at)
                VALUES ($patient_id, '$medicine', '$dosage', '$notes', '$prescribed_at')";

        if ($conn->query($sql) === TRUE) {
            header("Location: ../pages/prescriptions.php");
            exit;
        } else {
            // You can log or show error here for debugging
            echo "Error: " . $conn->error;
            // Or redirect with failure flag:
            // header("Location: ../pages/add_prescription.php?saved=0"); exit;
        }
    } else {
        header("Location: ../pages/add_prescription.php?saved=0");
        exit;
    }
} else {
    header("Location: ../pages/add_prescription.php");
    exit;
}
