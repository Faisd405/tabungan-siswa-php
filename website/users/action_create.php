<?php

include_once '../../config/database.php';
include_once '../../config/authorization.php';

// Users
$username = $_POST['username'];
$password = $_POST['password'];
$role = $_POST['role'];

if (!in_array($role, ['staff', 'siswa'])) {
    header('Location: create.php');
}

// Query
$passwordHash = password_hash($password, PASSWORD_DEFAULT);
$query = "INSERT INTO users (username, password, role) VALUES ('$username', '" . $passwordHash . "', '$role')";

// Execute
if (mysqli_query($conn, $query)) {
    header('Location: index.php');
} else {
    echo "Error: " . $query . "<br>" . mysqli_error($conn);
}
