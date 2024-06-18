<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "login_system";

try {
    $connection = mysqli_connect($servername, $username, $password, $dbname);
}
catch (Exception $e) {
    die("Failed to connect to Database due to : " . $e->getMessage());
}