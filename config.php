<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
// Database configuration
$host = "localhost";
$username = "root";
$password = "";
$database = "uv_project";

try {
    // Create a PDO connection
    $pdo = new PDO("mysql:host=$host;dbname=$database", $username, $password);

    // Set PDO attributes
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

include 'lib/function.php';
