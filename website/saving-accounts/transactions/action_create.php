<?php

include_once '../../../config/database.php';
include_once '../../../config/authorization.php';

// Transaction
$accountId = $_POST['account_id'];
$transactionDate = $_POST['transaction_date'];
$transactionType = $_POST['transaction_type'];
$amount = str_replace(',', '', $_POST['amount']);
$staffId = $_SESSION['user']['id'];

// Check Account
$account = $conn->query("SELECT * FROM savings_accounts WHERE id = $accountId")->fetch_assoc();
if (!$account) {
    header('Location: create.php');
    session_start();
    $_SESSION['error'] = 'Akun tidak ditemukan';
    exit();
}

if ($transactionType == 'Withdraw' && $account['balance'] < $amount) {
    header('Location: create.php');
    session_start();
    $_SESSION['error'] = 'Saldo tidak mencukupi';
    exit();
}

if ($amount <= 0) {
    header('Location: create.php');
    session_start();
    $_SESSION['error'] = 'Jumlah harus lebih dari 0';
    exit();
}

// Query
$queryInsert  = "INSERT INTO transactions (account_id, transaction_date, transaction_type, amount, staff_id) VALUES ('$accountId', '$transactionDate', '$transactionType', '$amount', '$staffId')";

// Execute
if (!mysqli_query($conn, $queryInsert)) {
    echo "Error: " . $queryInsert . "<br>" . mysqli_error($conn);
    return;
}

// Get Total Amount Transaction
$queryTotalAmount = "SELECT SUM(amount) as total FROM transactions WHERE account_id = $accountId";

$totalAmount = $conn->query($queryTotalAmount)->fetch_assoc()['total'];

// Update Balance
$queryUpdateBalance = "UPDATE savings_accounts SET balance = $totalAmount WHERE id = $accountId";

if (!mysqli_query($conn, $queryUpdateBalance)) {
    echo "Error: " . $queryUpdateBalance . "<br>" . mysqli_error($conn);
    return;
}

header('Location: index.php?id=' . $accountId);
