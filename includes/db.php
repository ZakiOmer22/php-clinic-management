<?php

$ServerName = "localhost";
$Database = "clinic_db";
$user = "root";
$password = "";

$conn = mysqli_connect($ServerName, $user, $password, $Database);


if (!$conn) {
    echo "Connection Failed ... \n Check The Connection";
}

?>