<?php

include_once '../../config/database.php';
include_once '../../config/authorization.php';

// Siswa
$nis = $_POST['nis'];
$name = $_POST['name'];
$parent_name = $_POST['parent_name'];
$class = $_POST['class'];
$date_of_birth = $_POST['date_of_birth'];
$address = $_POST['address'];
$user_id = $_POST['user_id'] ?? null;

// Query
if ($user_id) {
    $query = "INSERT INTO students (nis, name, parent_name, class, date_of_birth, address, user_id) VALUES ('$nis', '$name', '$parent_name', '$class', '$date_of_birth', '$address', '$user_id')";

    $user = mysqli_query($conn, "SELECT * FROM users WHERE id='$user_id'");
    if (mysqli_num_rows($user) == 0) {
        echo "User not found";
        exit;
    }
} else {
    $query = "INSERT INTO students (nis, name, parent_name, class, date_of_birth, address, user_id) VALUES ('$nis', '$name', '$parent_name', '$class', '$date_of_birth', '$address', null)";
}

// Execute
if (mysqli_query($conn, $query)) {
    header('Location: index.php');
} else {
    echo "Error: " . $query . "<br>" . mysqli_error($conn);
}
