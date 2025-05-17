<?php
$servername = "localhost";
$username = "root";  // Username for MySQL
$password = "";  // Password (leave it empty if you don't have one)
$dbname = "pet_adoption";  // The database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
