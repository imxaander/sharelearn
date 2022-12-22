<?php 
$servername = "localhost";
$username = "root";
$password = "";

// Create connection
$con = new mysqli($servername, $username, $password);

// Check connection
if ($con->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>