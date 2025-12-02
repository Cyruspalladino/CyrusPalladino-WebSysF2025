<?php
$host = "localhost";
$user = "root";                // MySQL username
$password = "WaterLight33?"; // Replace with your MySQL root password
$database = "ITWS2110-Fall2025-pallac-Quiz2";

// Create connection
$conn = new mysqli($host, $user, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
