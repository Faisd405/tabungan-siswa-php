<?php

include_once '../../config/database.php';
include_once '../../config/authorization.php';

// Saving Account
$accountId = $_GET['id'];

// Query
$queryDelete = "DELETE FROM users WHERE id = $accountId";

// Check Relation students, transactions
$queryCheckRelationStudent = "SELECT * FROM students WHERE user_id = $accountId";
$data = $conn->query($queryCheckRelationStudent);
$student = $data->fetch_assoc();

if ($student) {
    header('Location: index.php');
    session_start();
    $_SESSION['error'] = 'Masih ada data siswa yang terkait';
    return;
}

$queryCheckRelationTransaction = "SELECT * FROM transactions WHERE staff_id = $accountId";
$data = $conn->query($queryCheckRelationTransaction);
$transaction = $data->fetch_assoc();

if ($transaction) {
    header('Location: index.php');
}

// Execute
if (!mysqli_query($conn, $queryDelete)) {
    echo "Error: " . $queryDelete . "<br>" . mysqli_error($conn);
    return;
}

header('Location: index.php');