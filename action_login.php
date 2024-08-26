<?php

include_once './config/database.php';

// Login
$username = $_POST['username'];
$password = $_POST['password'];

// Query
$query = "SELECT * FROM users WHERE username = '$username'";

// password_verify
$data = $conn->query($query);
$user = $data->fetch_assoc();

if (!$user) {
    header('Location: login.php?error=username');
    return;
}

if (!password_verify($password, $user['password'])) {
    header('Location: login.php?error=password');
    return;
}


session_start();
$_SESSION['user'] = $user;
header('Location: ../index.php');
