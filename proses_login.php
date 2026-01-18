<?php
session_start();
include "config.php";

if (!isset($_POST['username'], $_POST['password'])) {
    header("Location: login.php");
    exit;
}

$input    = mysqli_real_escape_string($conn, $_POST['username']);
$password = $_POST['password'];

$query = mysqli_query($conn, "
    SELECT * FROM users 
    WHERE username='$input' OR email='$input'
");

if (!$query) {
    die("Query error: " . mysqli_error($conn));
}

$user = mysqli_fetch_assoc($query);

if (!$user) {
    echo "<script>alert('Username / Email tidak ditemukan');location='login.php';</script>";
    exit;
}

if (!password_verify($password, $user['password'])) {
    echo "<script>alert('Password salah');location='login.php';</script>";
    exit;
}


$_SESSION['id_user']  = $user['id_user'];
$_SESSION['username'] = $user['username'];
$_SESSION['role']     = $user['role'];

if ($user['role'] === 'admin') {
    header("Location: dashboard_admin.php");
} else {
    header("Location: dashboard.php");
}
exit;
