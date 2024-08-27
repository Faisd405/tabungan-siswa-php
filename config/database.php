<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "tabungan_siswa_web";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
