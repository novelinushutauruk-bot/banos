<?php
session_start();
include "config.php";

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    mysqli_query($conn,"DELETE FROM keluarga WHERE id='$id'");
}

header("Location: kelola_data_keluarga.php");
exit;
