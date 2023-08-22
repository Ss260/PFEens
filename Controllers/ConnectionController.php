<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "rental";

// Create a connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo "Connected successfully";

// Close the connection when done
$conn->close();
?>
