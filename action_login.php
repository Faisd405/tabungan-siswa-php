<?php

include_once './config/database.php';

session_start();

// Login
$username = $_POST['username'];
$password = $_POST['password'];

// Query
$query = "SELECT * FROM users WHERE username = '$username'";

// password_verify
$data = $conn->query($query);
$user = $data->fetch_assoc();

if (!$user) {
    header('Location: login.php');
    $_SESSION['error'] = 'User tidak ditemukan';
    return;
}

if (!password_verify($password, $user['password'])) {
    header('Location: login.php');
    $_SESSION['error'] = 'Password salah';
    return;
}


$_SESSION['user'] = $user;
header('Location: ../index.php');
