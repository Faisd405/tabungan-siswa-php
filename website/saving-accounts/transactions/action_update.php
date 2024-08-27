<?php

include_once '../../../config/database.php';
include_once '../../../config/authorization.php';

session_start();

// Update Transaction
$id = $_POST['id'];
$transactionDate = $_POST['transaction_date'];
$transactionType = $_POST['transaction_type'];
$amount = str_replace(',', '', $_POST['amount']);
$staffId = $_SESSION['user']['id'];

// Query
$query = "UPDATE transactions SET transaction_date = '$transactionDate', transaction_type = '$transactionType', amount = '$amount', staff_id = '$staffId' WHERE id = $id";

// Check Transaction\
$transaction = $conn->query("SELECT * FROM transactions WHERE id = $id")->fetch_assoc();
if (!$transaction) {
    header('Location: index.php?id=' . $id);
    $_SESSION['error'] = 'Akun tidak ditemukan';
    exit();
}

if ($transactionType == 'Withdraw' && $account['balance'] < $amount) {
    header('Location: index.php');
    $_SESSION['error'] = 'Saldo tidak mencukupi';
    exit();
}

if ($amount <= 0) {
    header('Location: index.php');
    $_SESSION['error'] = 'Jumlah harus lebih dari 0';
    exit();
}

// Execute
if (!mysqli_query($conn, $query)) {
    echo "Error: " . $query . "<br>" . mysqli_error($conn);
    return;
}

// Get Total Amount Transaction
$accountId = $transaction['account_id'];
$queryTotalAmount = "SELECT SUM(amount) as total FROM transactions WHERE account_id = $accountId";

$totalAmount = $conn->query($queryTotalAmount)->fetch_assoc()['total'];

// Update Balance
$queryUpdateBalance = "UPDATE savings_accounts SET balance = $totalAmount WHERE id = $accountId";

if (!mysqli_query($conn, $queryUpdateBalance)) {
    echo "Error: " . $queryUpdateBalance . "<br>" . mysqli_error($conn);
    return;
}

header('Location: index.php?id=' . $accountId);
