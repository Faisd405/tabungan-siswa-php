<?php

include_once '../../config/database.php';
include_once '../../config/authorization.php';

// Saving Account
$accountId = $_GET['id'];

// Query
$queryDelete = "DELETE FROM students WHERE id = $accountId";

// Check Relation savings_accounts
$queryCheckRelationSavingAccount = "SELECT * FROM savings_accounts WHERE student_id = $accountId";
$data = $conn->query($queryCheckRelationSavingAccount);
$savingAccount = $data->fetch_assoc();

if ($savingAccount) {
    header('Location: index.php');
    session_start();
    $_SESSION['error'] = 'Masih ada data tabungan yang terkait';
    return;
}

// Execute
if (!mysqli_query($conn, $queryDelete)) {
    echo "Error: " . $queryDelete . "<br>" . mysqli_error($conn);
    return;
}

header('Location: index.php');

