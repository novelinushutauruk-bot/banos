<?php
session_start();
include "config.php";

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

$id = (int)$_GET['id'];
mysqli_query($conn,"DELETE FROM bobot_kriteria WHERE id='$id'");

header("Location: kelola_bobot.php");
exit;
