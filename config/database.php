<?php

$host = "localhost";
$username = "root";
$password = "";
$database = "lazada";
$conn = mysqli_connect($host, $username, $password, $database);
if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

$dsn = "mysql:host=$host;dbname=$database;charset=utf8mb4";
try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    // Jika gagal, tampilkan pesan error yang rapi
    die("Ups! Koneksi Database Gagal: " . $e->getMessage());
}
?>