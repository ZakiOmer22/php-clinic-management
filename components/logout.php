<?php
session_start();
session_unset();
session_destroy();

// Redirect to login page or homepage after logout
header("Location: ../pages/login.php");
exit();

