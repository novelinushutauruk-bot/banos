<?php
session_start();
include "config.php";

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

$id = (int)$_GET['id'];
mysqli_query($conn, "DELETE FROM riwayat_penilaian WHERE id=$id");
header("Location: kelola_alternatif.php");
exit;
?>
