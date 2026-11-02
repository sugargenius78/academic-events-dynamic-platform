<?php
$host = 'localhost';
$user = 'root';
$password = 'Reem1234@';
$database = 'website';

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("connection failed: " . $conn->connect_error);
}
?>