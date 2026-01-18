<?php
session_start();
include "config.php";

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

if (!isset($_GET['id'])) {
    header("Location: kelola_kriteria.php");
    exit;
}

$id = (int)$_GET['id'];
$q = mysqli_query($conn,"SELECT * FROM kriteria WHERE id='$id'");
$data = mysqli_fetch_assoc($q);

if (!$data) {
    header("Location: kelola_kriteria.php");
    exit;
}

if (isset($_POST['update'])) {
    $nama = mysqli_real_escape_string($conn,$_POST['nama']);
    $tipe = $_POST['tipe'];

    mysqli_query($conn,"UPDATE kriteria SET
        nama_kriteria='$nama',
        tipe='$tipe'
        WHERE id='$id'
    ");

    header("Location: kelola_kriteria.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Edit Kriteria</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
<style>
*{margin:0;padding:0;box-sizing:border-box;font-family:'Poppins',sans-serif;}
body{background:#f4f7fa;}

.wrapper{display:flex;min-height:100vh;}
.main{flex:1;padding:30px;}

.card{
    background:#fff;
    max-width:500px;
    margin:auto;
    border-radius:12px;
    box-shadow:0 10px 25px rgba(0,0,0,.08);
    padding:30px;
}

.card h3{
    margin-bottom:20px;
    color:#2e7d32;
    text-align:center;
}

.form-group{
    margin-bottom:18px;
}

label{
    display:block;
    margin-bottom:6px;
    font-weight:500;
    color:#333;
}

input,select{
    width:100%;
    padding:10px 12px;
    border-radius:8px;
    border:1px solid #ccc;
    outline:none;
    font-size:14px;
}

input:focus,select:focus{
    border-color:#2b8cff;
}

.btn-group{
    display:flex;
    justify-content:space-between;
    margin-top:25px;
}

.btn{
    padding:10px 18px;
    border:none;
    border-radius:8px;
    cursor:pointer;
    font-size:14px;
    text-decoration:none;
}

.btn-save{
    background:#2ecc71;
    color:#fff;
}

.btn-back{
    background:#e0e0e0;
    color:#333;
}

.btn-save:hover{opacity:.9}
.btn-back:hover{background:#d5d5d5}
</style>
</head>
<body>

<div class="wrapper">
    <div class="main">

        <div class="card">
            <h3>Edit Kriteria</h3>

            <form method="post">
                <div class="form-group">
                    <label>Nama Kriteria</label>
                    <input type="text" name="nama"
                           value="<?= htmlspecialchars($data['nama_kriteria']) ?>"
                           required>
                </div>

                <div class="form-group">
                    <label>Tipe Kriteria</label>
                    <select name="tipe" required>
                        <option value="Benefit" <?= $data['tipe']=='Benefit'?'selected':'' ?>>Benefit</option>
                        <option value="Cost" <?= $data['tipe']=='Cost'?'selected':'' ?>>Cost</option>
                    </select>
                </div>

                <div class="btn-group">
                    <a href="kelola_kriteria.php" class="btn btn-back">← Kembali</a>
                    <button type="submit" name="update" class="btn btn-save">Update</button>
                </div>
            </form>
        </div>

    </div>
</div>

</body>
</html>
