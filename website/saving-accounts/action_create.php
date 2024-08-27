<?php

include_once '../../config/database.php';
include_once '../../config/authorization.php';

// Tabungan
$studentId = $_POST['student_id'];
$balance = str_replace(',', '', $_POST['balance']);

// Generate account number, SA_studentId_timestamp
$accountNumber = 'SA_' . $studentId . '_' . time();

// Check if student_id is exist
$data = $conn->query("SELECT * FROM students WHERE id = $studentId");
$student = $data->fetch_assoc();

if (!$student) {
    header('Location: index.php');
    $_SESSION['error'] = 'Siswa tidak ditemukan';
    return;
}

$data = $conn->query("SELECT * FROM savings_accounts WHERE student_id = $studentId");
$student = $data->fetch_assoc();

if ($student) {
    header('Location: index.php');
    $_SESSION['error'] = 'Siswa sudah memiliki tabungan';
    return;
}

// Query
$queryInsert = "INSERT INTO savings_accounts (student_id, balance, account_number) VALUES ('$studentId', '$balance', '$accountNumber')";


// Execute
if (!mysqli_query($conn, $queryInsert)) {
    echo "Error: " . $queryInsert . "<br>" . mysqli_error($conn);
    return;
}

$accountId = mysqli_insert_id($conn);
$transactionType = 'deposit';
$transactionDate = date('Y-m-d H:i:s');
$staffId = $_SESSION['user']['id'];
$queryCreateTransaction = "INSERT INTO transactions (account_id, transaction_type, amount, transaction_date, staff_id) VALUES ('$accountId', '$transactionType', '$balance', '$transactionDate', '$staffId')";

if (!mysqli_query($conn, $queryCreateTransaction)) {
    echo "Error: " . $queryCreateTransaction . "<br>" . mysqli_error($conn);
    return;
}

header('Location: index.php');
