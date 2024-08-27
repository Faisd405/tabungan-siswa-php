<?php

include_once '../../../config/database.php';
include_once '../../../config/authorization.php';

// Saving Account
$id = $_GET['id'];

// Query
$queryDelete = "DELETE FROM transactions WHERE id = $id";

// Get AccountId
$transaction = $conn->query("SELECT id,account_id FROM transactions WHERE id = $id")->fetch_assoc();
if (!$transaction) {
    header('Location: index.php?id=' . $id . '');
    session_start();
    $_SESSION['error'] = 'Transaction not found';
    exit();
}


// Execute
if (!mysqli_query($conn, $queryDelete)) {
    echo "Error: " . $queryDelete . "<br>" . mysqli_error($conn);
    return;
}

// Get Total Amount Transaction
$accountId = $transaction['account_id'];
$queryTotalAmount = "SELECT SUM(amount) as total FROM transactions WHERE account_id = $accountId";

$totalAmount = $conn->query($queryTotalAmount)->fetch_assoc()['total'];

if (!$totalAmount) {
    $totalAmount = 0;
}

// Update Balance
$queryUpdateBalance = "UPDATE savings_accounts SET balance = $totalAmount WHERE id = $accountId";

if (!mysqli_query($conn, $queryUpdateBalance)) {
    echo "Error: " . $queryUpdateBalance . "<br>" . mysqli_error($conn);
    return;
}

header('Location: index.php?id=' . $accountId);
