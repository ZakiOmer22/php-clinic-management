<?php
include '../includes/db.php';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']);

    // Prepare and execute
    $stmt = $conn->prepare("DELETE FROM prescriptions WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: prescriptions.php?msg=deleted");
    } else {
        header("Location: prescriptions.php?msg=error");
    }

    $stmt->close();
} else {
    header("Location: prescriptions.php?msg=invalid");
}
exit;
