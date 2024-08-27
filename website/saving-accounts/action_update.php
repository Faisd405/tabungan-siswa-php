<?php

include_once '../../config/database.php';
include_once '../../config/authorization.php';

// Update Saving Account
$id = $_POST['id'];
$studentId = $_POST['student_id'];

// Check if student_id is exist
$data = $conn->query("SELECT * FROM students WHERE id = $studentId");
$student = $data->fetch_assoc();

if (!$student) {
    header('Location: index.php');
    $_SESSION['error'] = 'Siswa tidak ditemukan';
    return;
}

// Check if student already have saving account
$data = $conn->query("SELECT * FROM savings_accounts WHERE student_id = $studentId");
$student = $data->fetch_assoc();

if ($student) {
    header('Location: index.php');
    $_SESSION['error'] = 'Siswa sudah memiliki tabungan';
    return;
}

// Query
$queryUpdate = "UPDATE savings_accounts SET student_id = '$studentId' WHERE id = $id";

// Execute
if (!mysqli_query($conn, $queryUpdate)) {
    echo "Error: " . $queryUpdate . "<br>" . mysqli_error($conn);
    return;
}

header('Location: index.php');