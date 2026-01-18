<?php
// koneksi.php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "db_bansos";

// Membuat koneksi
$conn = new mysqli($host, $user, $pass, $db);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Set charset agar mendukung UTF-8
$conn->set_charset("utf8");
?>
