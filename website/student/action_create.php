<?php

include_once '../../config/database.php';
include_once '../../config/authorization.php';

// Student
$nis = $_POST['nis'];
$name = $_POST['name'];
$parent_name = $_POST['parent_name'];
$class = $_POST['class'];
$date_of_birth = $_POST['date_of_birth'];
$address = $_POST['address'];

// Query
$query = "INSERT INTO students (nis, name, parent_name, class, date_of_birth, address) VALUES ('$nis', '$name', '$parent_name', '$class', '$date_of_birth', '$address')";

// Execute
if (mysqli_query($conn, $query)) {
    header('Location: index.php');
} else {
    echo "Error: " . $query . "<br>" . mysqli_error($conn);
}
