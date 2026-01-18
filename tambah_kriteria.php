<?php
session_start();
include "config.php";

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

if (isset($_POST['simpan'])) {
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $tipe = $_POST['tipe'];

    mysqli_query($conn, "INSERT INTO kriteria (nama_kriteria, tipe)
        VALUES ('$nama', '$tipe')");

    header("Location: kelola_kriteria.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Tambah Kriteria</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
<style>
body{background:#f4f7fa;font-family:Poppins;}
.box{
    width:420px;margin:80px auto;
    background:#fff;padding:30px;
    border-radius:10px;
    box-shadow:0 6px 20px rgba(0,0,0,.1);
}
input,select,button{
    width:100%;padding:10px;margin-top:10px;
    border-radius:6px;border:1px solid #ccc;
}
button{background:#2b8cff;color:#fff;border:none;}
</style>
</head>
<body>

<div class="box">
<h3>Tambah Kriteria</h3>
<form method="post">
<input name="nama" placeholder="Nama Kriteria" required>
<select name="tipe" required>
    <option value="">-- Pilih Tipe --</option>
    <option value="Benefit">Benefit</option>
    <option value="Cost">Cost</option>
</select>
<button name="simpan">Simpan</button>
</form>
</div>

</body>
</html>
