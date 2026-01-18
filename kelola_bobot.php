<?php
session_start();
include "config.php";

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

$current = basename($_SERVER['PHP_SELF']);

/* Ambil data bobot + nama kriteria */
$query = mysqli_query($conn, "
    SELECT 
        bobot_kriteria.id,
        kriteria.nama_kriteria,
        bobot_kriteria.bobot
    FROM bobot_kriteria
    JOIN kriteria ON bobot_kriteria.id_kriteria = kriteria.id
    ORDER BY bobot_kriteria.id ASC
");
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Kelola Bobot Topsis</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
<style>
*{margin:0;padding:0;box-sizing:border-box;font-family:'Poppins',sans-serif;}
body{background:#f4f7fa;}
.wrapper{display:flex;min-height:100vh;}

/* ===== SIDEBAR ===== */
.sidebar{width:260px;background:linear-gradient(180deg,#8ee0b0,#5ac89a);padding:20px;}
.profile{text-align:center;margin-bottom:30px;}
.profile img{width:90px;height:90px;border-radius:50%;border:3px solid #fff;}
.profile h4{margin-top:10px;color:#1b3d2f;}
.menu a{display:block;padding:12px;margin-bottom:8px;color:#0f3d2e;text-decoration:none;border-radius:8px;}
.menu a.active,.menu a:hover{background:#fff;color:#2f7d5c;font-weight:600;}

/* ===== MAIN ===== */
.main{flex:1;background:#fff;}
.topbar{display:flex;justify-content:space-between;align-items:center;padding:18px 30px;border-bottom:1px solid #eee;}
.logout{background:#e53935;color:#fff;border:none;padding:7px 16px;border-radius:6px;cursor:pointer;}

/* ===== CONTENT ===== */
.content{padding:25px;}
.content h2{color:#1b5e20;margin-bottom:20px;}

/* Tombol tambah */
.add-btn{
    display:inline-block;
    margin-bottom:15px;
    background:#2b8cff;
    color:#fff;
    padding:10px 16px;
    border-radius:8px;
    font-size:14px;
    text-decoration:none;
}
.add-btn:hover{background:#1f6fe0;}

/* ===== TABEL ===== */
table{
    width:100%;
    border-collapse:collapse;
    background:#fff;
    border-radius:10px;
    overflow:hidden;
    box-shadow:0 8px 20px rgba(0,0,0,0.05);
    margin-top:10px;
}
thead{background:#e8f5ee;}
th{
    padding:14px 12px;
    text-align:center;
    font-weight:600;
    font-size:14px;
    color:#1b3d2f;
    border-bottom:2px solid #d6efe2;
}
td{
    padding:12px;
    font-size:14px;
    color:#333;
    border-bottom:1px solid #eee;
}
tbody tr:hover{background:#f9fdfb;}
td:nth-child(1), td:nth-child(3){text-align:center;}

/* Kolom aksi */
.action{text-align:center;white-space:nowrap;}
.action a{
    display:inline-block;
    padding:6px 12px;
    margin:2px;
    border-radius:6px;
    font-size:12px;
    color:#fff;
    text-decoration:none;
    transition:0.2s;
}
.edit{background:#2ecc71;}
.edit:hover{background:#27ae60;}
.delete{background:#e74c3c;}
.delete:hover{background:#c0392b;}
</style>
</head>
<body>
<div class="wrapper">
<?php include "sidebar_admin.php"; ?>

<div class="main">
    <div class="topbar">
        <div class="logo">
            <img src="logo.png" width="160">
        </div>
        <form method="post" action="logout.php">
            <button class="logout">Logout</button>
        </form>
    </div>

    <div class="content">
        <h2>Kelola Bobot Topsis</h2>
        <a href="tambah_bobot.php" class="add-btn">+ Tambah Bobot</a>

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Kriteria</th>
                    <th>Bobot</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php $no = 1; ?>
            <?php while ($row = mysqli_fetch_assoc($query)): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= htmlspecialchars($row['nama_kriteria']) ?></td>
                    <td><?= number_format($row['bobot'],2) ?></td>
                    <td class="action">
                        <a href="edit_bobot.php?id=<?= $row['id'] ?>" class="edit">Edit</a>
                        <a href="hapus_bobot.php?id=<?= $row['id'] ?>" class="delete" onclick="return confirm('Yakin hapus bobot ini?')">Hapus</a>
                    </td>
                </tr>
            <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>
</div>
</body>
</html>
