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
    header('Location: login.php');
    session_start();
    $_SESSION['error'] = 'User tidak ditemukan';
    return;
}

if (!password_verify($password, $user['password'])) {
    header('Location: login.php');
    session_start();
    $_SESSION['error'] = 'Password salah';
    return;
}


session_start();
$_SESSION['user'] = $user;
header('Location: ../index.php');
