<?php

session_start();
/*
 * Configuration information is stored here.
 */
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "eclass";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>
