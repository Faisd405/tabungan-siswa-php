<?php

include_once '../../config/database.php';

// Update Student
$id = $_POST['id'];
$nis = $_POST['nis'];
$name = $_POST['name'];
$parent_name = $_POST['parent_name'];
$class = $_POST['class'];
$date_of_birth = $_POST['date_of_birth'];
$address = $_POST['address'];

// Query
$query = "UPDATE students SET nis = '$nis', name = '$name', parent_name = '$parent_name', class = '$class', date_of_birth = '$date_of_birth', address = '$address' WHERE id = $id";

// Execute
if (mysqli_query($conn, $query)) {
    header('Location: index.php');
} else {
    echo "Error: " . $query . "<br>" . mysqli_error($conn);
}
