<?php

include_once '../../config/database.php';
include_once '../../config/authorization.php';

// Users
$id = $_POST['id'];
$username = $_POST['username'];
$password = $_POST['password'];
$role = $_POST['role'];

if (!in_array($role, ['staff', 'siswa'])) {
    header('Location: index.php');
}

// Query
if (!empty($password)) {
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
    $query = "UPDATE users SET username = '$username', password = '" . $passwordHash . "', role = '$role' WHERE id = $id";
} else {
    $query = "UPDATE users SET username = '$username', role = '$role' WHERE id = $id";
}

// Execute
if (mysqli_query($conn, $query)) {
    header('Location: index.php');
} else {
    echo "Error: " . $query . "<br>" . mysqli_error($conn);
}
