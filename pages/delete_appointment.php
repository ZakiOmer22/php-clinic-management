<?php
include '../includes/db.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $stmt = "DELETE FROM appointments WHERE id = $id";
    mysqli_query($conn, $stmt);
}

header("Location: appointments.php");
exit();
?>
