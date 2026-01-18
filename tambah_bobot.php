<?php
session_start();
include "config.php";

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

$kriteria = mysqli_query($conn,"SELECT * FROM kriteria");

if (isset($_POST['simpan'])) {
    $id_kriteria = (int)$_POST['id_kriteria'];
    $bobot = (float)$_POST['bobot'];

    mysqli_query($conn,"
        INSERT INTO bobot_kriteria (id_kriteria, bobot)
        VALUES ('$id_kriteria','$bobot')
    ");

    header("Location: kelola_bobot.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Tambah Bobot</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
<style>
body{font-family:Poppins;background:#f4f7fa;}
.form-box{
    width:400px;margin:80px auto;background:#fff;
    padding:25px;border-radius:10px;
    box-shadow:0 4px 15px rgba(0,0,0,.1);
}
h3{text-align:center;margin-bottom:20px;}
input,select,button{
    width:100%;padding:10px;margin-top:10px;
    border-radius:6px;border:1px solid #ccc;
}
button{
    background:#2b8cff;color:#fff;border:none;
}
</style>
</head>
<body>

<div class="form-box">
<h3>Tambah Bobot Kriteria</h3>
<form method="post">
<select name="id_kriteria" required>
    <option value="">-- Pilih Kriteria --</option>
    <?php while($k=mysqli_fetch_assoc($kriteria)): ?>
        <option value="<?= $k['id'] ?>"><?= $k['nama_kriteria'] ?></option>
    <?php endwhile; ?>
</select>

<input type="number" step="0.01" name="bobot" placeholder="Bobot (contoh 0.30)" required>
<button name="simpan">Simpan</button>
</form>
</div>

</body>
</html>
