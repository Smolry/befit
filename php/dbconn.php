<?php
$servername = "servername";
$username = "username";
$password = "password";
$database = "db_name";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Set UTF-8 charset
$conn->set_charset("utf8mb4");

// Check connection
if ($conn->connect_error) {
    // Log error (for dev environment only)
    error_log("Connection failed: " . $conn->connect_error);
    die("Oops! We are facing technical issues. Please try again later.");
}
?>
