<?php
include '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $patient_id       = $_POST['patient_id'] ?? '';
    $doctor_name      = $_POST['doctor_name'] ?? '';
    $appointment_date = $_POST['appointment_date'] ?? '';
    $status           = $_POST['status'] ?? '';

    $sql = "INSERT INTO appointments (patient_id, doctor_name, appointment_date, status)
            VALUES ($patient_id, '$doctor_name', '$appointment_date', '$status')";

    if (mysqli_query($conn, $sql)) {
        header("Location: ../pages/appointments.php");
        exit;
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    header("Location: ../pages/add_appointment.php");
    exit;
}
?>
