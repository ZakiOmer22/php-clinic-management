<?php
include '../includes/db.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "DELETE FROM users WHERE id = $id";
    mysqli_query($conn, $sql);
}

header("Location: ../pages/users.php");
exit();
?>
