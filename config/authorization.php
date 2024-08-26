<?php

// Middleware Get Session User
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: ../login.php');
}
