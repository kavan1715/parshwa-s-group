<?php
$servername = "localhost";
$username = "root";
$password = ""; // Change if necessary
$dbname = "classroom_management"; // Ensure this database exists

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
