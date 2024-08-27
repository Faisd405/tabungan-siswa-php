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
    header('Location: /tabungan-siswa-web/login.php');
    $_SESSION['error'] = 'User tidak ditemukan';
    return;
}

if (!password_verify($password, $user['password'])) {
    header('Location: /tabungan-siswa-web/login.php');
    $_SESSION['error'] = 'Password salah';
    return;
}

if ($user['role'] == 'siswa') {
    $query = "SELECT * FROM students WHERE user_id = " . $user['id'];
    $data = $conn->query($query);
    $student = $data->fetch_assoc();

    if (!$student) {
        header('Location: /tabungan-siswa-web/login.php');
        $_SESSION['error'] = 'Siswa belum memiliki tabungan';
        return;
    }

    $user['student_id'] = $student['id'];
}


$_SESSION['user'] = $user;
header('Location: /tabungan-siswa-web/index.php');
