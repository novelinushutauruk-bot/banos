<?php
session_start();
include "config.php";

if (!isset($_SESSION['username']) || $_SESSION['username'] !== 'admin') {
    header("Location: login.php");
    exit;
}

$data = mysqli_query($conn, "SELECT * FROM keluarga ORDER BY id DESC");
$current = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Kelola Data Keluarga</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
<style>
*{margin:0;padding:0;box-sizing:border-box;font-family:'Poppins',sans-serif;}
body{background:#f4f7fa;}
.wrapper{display:flex;min-height:100vh;}
.sidebar{width:260px;background:linear-gradient(180deg,#8ee0b0,#5ac89a);padding:20px;}
.profile{text-align:center;margin-bottom:30px;}
.profile img{width:90px;height:90px;border-radius:15px;border:3px solid #fff;}
.profile h4{margin-top:10px;color:#1b3d2f;}
.menu a{display:block;padding:12px;margin-bottom:8px;color:#0f3d2e;text-decoration:none;border-radius:8px;}
.menu a.active,.menu a:hover{background:#fff;font-weight:600;}
.main{flex:1;background:#fff;}
.topbar{display:flex;justify-content:space-between;align-items:center;padding:18px 30px;border-bottom:1px solid #eee;}
.logout{background:#e53935;color:#fff;border:none;padding:7px 16px;border-radius:6px;}
.content{padding:30px;}
.add-btn{background:#2b8cff;color:#fff;padding:8px 14px;border-radius:6px;text-decoration:none;}
table{width:100%;border-collapse:collapse;margin-top:15px;}
th,td{padding:10px;border-bottom:1px solid #eee;}
.action a{color:#fff;padding:4px 10px;border-radius:4px;font-size:12px;text-decoration:none;}
.edit{background:#2ecc71;}
.delete{background:#e74c3c;}
</style>
</head>
<body>

<div class="wrapper">

<?php include "sidebar_admin.php"; ?>

<div class="main">
<h2>Kelola Data Keluarga</h2>
<a href="tambah_keluarga.php" class="add-btn">+ Tambah Data</a>

<table>
<tr>
    <th>No</th>
    <th>Nama</th>
    <th>Alamat</th>
    <th>Jumlah Anggota</th>
    <th>Pendapatan</th>
    <th>Aksi</th>
</tr>

<?php $no=1; while($d=mysqli_fetch_assoc($data)): ?>
<tr>
    <td><?= $no++ ?></td>
    <td><?= htmlspecialchars($d['nama']) ?></td>
    <td><?= htmlspecialchars($d['alamat']) ?></td>
    <td><?= $d['jumlah_anggota'] ?></td>
    <td>Rp <?= number_format($d['pendapatan']) ?></td>
    <td>
        <a href="edit_keluarga.php?id=<?= $d['id'] ?>" class="edit">Edit</a>
        <a href="hapus_keluarga.php?id=<?= $d['id'] ?>" 
           class="delete"
           onclick="return confirm('Hapus data ini?')">Hapus</a>
    </td>
</tr>
<?php endwhile; ?>
</table>
</div>
</div>
</body>
</html>