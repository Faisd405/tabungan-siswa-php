<?php

include_once '../../config/database.php';
include_once '../../config/authorization.php';

session_start();

// Tabungan
$accountId = $_GET['id'];

// Query
$queryDelete = "DELETE FROM savings_accounts WHERE id = $accountId";

// Check Relation transactions
$queryCheckRelationTransaction = "SELECT * FROM transactions WHERE account_id = $accountId";
$data = $conn->query($queryCheckRelationTransaction);
$transaction = $data->fetch_assoc();

if ($transaction) {
    header('Location: index.php');
    $_SESSION['error'] = 'Masih ada data transaksi yang terkait';
    return;
}

// Execute
if (!mysqli_query($conn, $queryDelete)) {
    echo "Error: " . $queryDelete . "<br>" . mysqli_error($conn);
    return;
}

header('Location: index.php');