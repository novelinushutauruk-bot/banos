<?php
include "config.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: daftar.php");
    exit;
}

$username = mysqli_real_escape_string($conn, $_POST['username']);
$email    = mysqli_real_escape_string($conn, $_POST['email']);
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$role     = 'user';

$cek = mysqli_query($conn, "
    SELECT id_user FROM users 
    WHERE username='$username' OR email='$email'
");

if (!$cek) {
    die("Query error: " . mysqli_error($conn));
}

if (mysqli_num_rows($cek) > 0) {
    echo "<script>alert('Username atau Email sudah terdaftar');location='daftar.php';</script>";
    exit;
}

$simpan = mysqli_query($conn, "
    INSERT INTO users (username, email, password, role)
    VALUES ('$username', '$email', '$password', '$role')
");

if ($simpan) {
    echo "<script>alert('Pendaftaran berhasil, silakan login');location='login.php';</script>";
} else {
    die("Gagal simpan: " . mysqli_error($conn));
}
