<?php
session_start();
include "config.php";

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

if (isset($_POST['simpan'])) {
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $alamat = mysqli_real_escape_string($conn, $_POST['alamat']);
    $jumlah = (int)$_POST['jumlah'];
    $pendapatan = (int)$_POST['pendapatan'];

    mysqli_query($conn,"INSERT INTO keluarga 
        (nama, alamat, jumlah_anggota, pendapatan)
        VALUES ('$nama','$alamat','$jumlah','$pendapatan')");

    header("Location: kelola_data_keluarga.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Tambah Keluarga</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
<style>
body{background:#f4f7fa;font-family:Poppins}
.form-box{
    width:420px;
    margin:80px auto;
    background:#fff;
    padding:30px;
    border-radius:10px;
    box-shadow:0 8px 20px rgba(0,0,0,.08);
}
h2{text-align:center;margin-bottom:20px}
input,textarea{
    width:100%;
    padding:10px;
    margin-bottom:15px;
    border:1px solid #ccc;
    border-radius:6px;
}
button{
    width:100%;
    background:#2b8cff;
    color:#fff;
    border:none;
    padding:12px;
    border-radius:6px;
    font-size:15px;
}
</style>
</head>
<body>

<div class="form-box">
<h2>Tambah Data Keluarga</h2>

<form method="post">
<input name="nama" placeholder="Nama Kepala Keluarga" required>
<textarea name="alamat" placeholder="Alamat" required></textarea>
<input type="number" name="jumlah" placeholder="Jumlah Anggota" required>
<input type="number" name="pendapatan" placeholder="Pendapatan" required>
<button name="simpan">Simpan Data</button>
</form>
</div>

</body>
</html>
