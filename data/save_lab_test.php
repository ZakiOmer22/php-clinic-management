<?php
include '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $patient_id = intval($_POST['patient_id'] ?? 0);
    $test_type = $conn->real_escape_string(trim($_POST['test_type'] ?? ''));
    $results = $conn->real_escape_string(trim($_POST['results'] ?? ''));
    $status = $conn->real_escape_string($_POST['status'] ?? 'Pending');  // default Pending if missing
    $test_date = $conn->real_escape_string($_POST['test_date'] ?? '');

    if ($patient_id && $test_type && $test_date) {
        $sql = "INSERT INTO lab_tests (patient_id, test_type, results, status, test_date)
                VALUES ($patient_id, '$test_type', '$results', '$status', '$test_date')";

        if ($conn->query($sql) === TRUE) {
            header("Location: ../pages/lab_tests.php");
            exit;
        } else {
            // Show error or redirect with failure
            echo "Error: " . $conn->error;
            // Or header("Location: ../pages/add_lab_test.php?saved=0"); exit;
        }
    } else {
        header("Location: ../pages/add_lab_test.php?saved=0");
        exit;
    }
} else {
    header("Location: ../pages/add_lab_test.php");
    exit;
}
?>
