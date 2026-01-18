<?php
session_start();
include "config.php";

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

$nama          = $_POST['nama'];
$alamat        = $_POST['alamat'];
$penghasilan   = $_POST['penghasilan'];
$tanggungan    = $_POST['tanggungan'];
$status_rumah  = $_POST['status_rumah'];

$query = mysqli_query($conn, "
    INSERT INTO warga 
    (nama, alamat, penghasilan, tanggungan, status_rumah)
    VALUES 
    ('$nama','$alamat','$penghasilan','$tanggungan','$status_rumah')
");

if ($query) {
    header("Location: kelola_keluarga.php");
} else {
    echo "Gagal menyimpan data: " . mysqli_error($conn);
}
