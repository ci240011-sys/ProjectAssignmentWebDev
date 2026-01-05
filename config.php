<?php
// config.php - Database connection
session_start();

$host = 'localhost';
$user = 'root';
$password = '';
$database = 'report_system';

// Create connection
$conn = mysqli_connect($host, $user, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if admin is logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: admin_login.php');
    exit();
}
?>