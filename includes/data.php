<?php
include '../includes/db.php';
function getTotalPatients($conn)
{
    $sql = "SELECT COUNT(*) as total FROM patients";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    return $row['total'] ?? 0;
}

function getTotalAppointments($conn)
{
    $sql = "SELECT COUNT(*) as total FROM appointments";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    return $row['total'] ?? 0;
}

function getTotalPrescriptions($conn)
{
    $sql = "SELECT COUNT(*) as total FROM prescriptions";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    return $row['total'] ?? 0;
}

function getTotalLabTests($conn)
{
    $sql = "SELECT COUNT(*) as total FROM lab_tests";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    return $row['total'] ?? 0;
}

function getPatientsThisMonth($conn)
{
    // Get first day and last day of current month
    $firstDay = date('Y-m-01');
    $lastDay = date('Y-m-t');

    $sql = "SELECT COUNT(*) as total FROM patients WHERE created_at BETWEEN '$firstDay' AND '$lastDay'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    return $row['total'] ?? 0;
}
