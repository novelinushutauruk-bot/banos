<?php
session_start();
include "config.php";

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

if(isset($_POST['submit'])){
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $pendapatan = (int)$_POST['pendapatan'];
    $anggota = (int)$_POST['anggota'];
    $pendidikan = mysqli_real_escape_string($conn, $_POST['pendidikan']);
    $kondisi_rumah = mysqli_real_escape_string($conn, $_POST['kondisi_rumah']);
    $aset = mysqli_real_escape_string($conn, $_POST['aset']);

    mysqli_query($conn, "INSERT INTO riwayat_penilaian (nama, pendapatan, anggota, pendidikan, kondisi_rumah, aset) VALUES ('$nama', $pendapatan, $anggota, '$pendidikan', '$kondisi_rumah', '$aset')");
    header("Location: kelola_alternatif.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Tambah Alternatif</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
<style>
*{margin:0;padding:0;box-sizing:border-box;font-family:'Poppins',sans-serif;}
body{background:#f4f7fa;}
.wrapper{display:flex;min-height:100vh;}
.sidebar{width:260px;background:linear-gradient(180deg,#8ee0b0,#5ac89a);padding:20px;}
.profile{text-align:center;margin-bottom:30px;}
.profile img{width:90px;height:90px;border-radius:50%;border:3px solid #fff;}
.profile h4{margin-top:10px;color:#1b3d2f;}
.menu a{display:block;padding:12px;margin-bottom:8px;color:#0f3d2e;text-decoration:none;border-radius:8px;}
.menu a.active,.menu a:hover{background:#fff;font-weight:600;}
.main{flex:1;background:#fff;}
.topbar{display:flex;justify-content:space-between;align-items:center;padding:18px 30px;border-bottom:1px solid #eee;}
.logout{background:#e53935;color:#fff;border:none;padding:7px 16px;border-radius:6px;cursor:pointer;}
.content{padding:25px;}
.content h2{color:#1b5e20;margin-bottom:20px;}
.form-box{background:#fff;padding:25px;border-radius:10px;box-shadow:0 8px 20px rgba(0,0,0,0.05);}
.form-box label{display:block;margin-bottom:6px;font-weight:600;}
.form-box input, .form-box select{width:100%;padding:10px 12px;margin-bottom:15px;border:1px solid #ccc;border-radius:6px;font-size:14px;}
.submit-btn{background:#2b8cff;color:#fff;padding:10px 16px;border:none;border-radius:8px;font-size:14px;cursor:pointer;}
.submit-btn:hover{background:#1f6fe0;}
</style>
</head>
<body>
<div class="wrapper">
<?php include "sidebar_admin.php"; ?>
<div class="main">
    <div class="topbar">
        <div class="logo"><img src="logo.png" width="160"></div>
        <form method="post" action="logout.php"><button class="logout">Logout</button></form>
    </div>

    <div class="content">
        <h2>Tambah Alternatif</h2>
        <div class="form-box">
            <form method="post">
                <label>Nama</label>
                <input type="text" name="nama" required>

                <label>Pendapatan</label>
                <input type="number" name="pendapatan" required>

                <label>Jumlah Anggota</label>
                <input type="number" name="anggota" required>

                <label>Pendidikan</label>
                <select name="pendidikan" required>
                    <option value="">--Pilih--</option>
                    <option value="SD">SD</option>
                    <option value="SMP">SMP</option>
                    <option value="SMA">SMA</option>
                    <option value="Diploma">Diploma</option>
                    <option value="Sarjana">Sarjana</option>
                </select>

                <label>Kondisi Rumah</label>
                <select name="kondisi_rumah" required>
                    <option value="">--Pilih--</option>
                    <option value="Layak">Layak</option>
                    <option value="Kurang Layak">Kurang Layak</option>
                </select>

                <label>Aset</label>
                <select name="aset" required>
                    <option value="">--Pilih--</option>
                    <option value="Banyak">Banyak</option>
                    <option value="Sedikit">Sedikit</option>
                </select>

                <button type="submit" name="submit" class="submit-btn">Simpan</button>
            </form>
        </div>
    </div>
</div>
</div>
</body>
</html>
