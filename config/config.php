<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "shikshyaverse";

// Create Connection
$conn = mysqli_connect($servername, $username, $password, $database);

// Check Connection
if (!$conn) {
    die("Connection Failed: " . mysqli_connect_error());
}

?>