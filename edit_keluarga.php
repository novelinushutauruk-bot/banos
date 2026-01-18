<?php
session_start();
include "config.php";

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

$id = (int)$_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM keluarga WHERE id='$id'"));

if (!$data) {
    header("Location: kelola_data_keluarga.php");
    exit;
}

if (isset($_POST['update'])) {
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $alamat = mysqli_real_escape_string($conn, $_POST['alamat']);
    $jumlah = (int)$_POST['jumlah'];
    $pendapatan = (int)$_POST['pendapatan'];

    mysqli_query($conn,"UPDATE keluarga SET
        nama='$nama',
        alamat='$alamat',
        jumlah_anggota='$jumlah',
        pendapatan='$pendapatan'
        WHERE id='$id'");

    header("Location: kelola_data_keluarga.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Edit Keluarga</title>
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
    background:#2ecc71;
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
<h2>Edit Data Keluarga</h2>

<form method="post">
<input name="nama" value="<?= htmlspecialchars($data['nama']) ?>" required>
<textarea name="alamat" required><?= htmlspecialchars($data['alamat']) ?></textarea>
<input type="number" name="jumlah" value="<?= $data['jumlah_anggota'] ?>" required>
<input type="number" name="pendapatan" value="<?= $data['pendapatan'] ?>" required>
<button name="update">Update Data</button>
</form>
</div>

</body>
</html>
