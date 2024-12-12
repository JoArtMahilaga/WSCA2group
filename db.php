<?php
$servername = "localhost"; // Use "localhost" when running on the same machine
$username = "root"; // Use "root" for the MySQL user in the Docker container
$password = "mysql"; // MySQL root password
$dbname = "WEB_SERVICES_CA"; // The database name

// Create connection
global $conn;
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
