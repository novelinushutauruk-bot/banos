<?php
session_start();
include "config.php";

// hanya user yang boleh input
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'user') {
    header("Location: login.php");
    exit;
}

// ambil data dari form
$nama          = $_POST['nama'];
$alamat        = $_POST['alamat'];
$penghasilan   = $_POST['penghasilan'];
$tanggungan    = $_POST['tanggungan'];
$status_rumah  = $_POST['status_rumah'];

// simpan ke tabel warga
$query = mysqli_query($conn, "
    INSERT INTO warga 
    (nama, alamat, penghasilan, tanggungan, status_rumah)
    VALUES
    ('$nama', '$alamat', '$penghasilan', '$tanggungan', '$status_rumah')
");

if ($query) {
    // kembali ke halaman input
    header("Location: input_data.php?status=success");
} else {
    echo "Gagal menyimpan data: " . mysqli_error($conn);
}
