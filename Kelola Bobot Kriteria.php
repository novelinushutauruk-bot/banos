<?php
session_start();
include "config.php";

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

$current = basename($_SERVER['PHP_SELF']);

/* Ambil data bobot + nama kriteria */
$data = mysqli_query($conn,"
    SELECT bk.id, k.nama_kriteria, bk.bobot
    FROM bobot_kriteria bk
    JOIN kriteria k ON bk.id_kriteria = k.id
    ORDER BY k.id ASC
");
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Kelola Bobot Kriteria</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
<style>
*{margin:0;padding:0;box-sizing:border-box;font-family:'Poppins',sans-serif;}
body{background:#f4f7fa;}
.wrapper{display:flex;min-height:100vh;}

/* ===== SIDEBAR ===== */
.sidebar{
    width:260px;
    background:linear-gradient(180deg,#8ee0b0,#5ac89a);
    padding:20px;
}
.profile{text-align:center;margin-bottom:30px;}
.profile img{
    width:90px;height:90px;border-radius:15px;border:3px solid #fff;
}
.profile h4{margin-top:10px;color:#1b3d2f;font-weight:600;}

.menu a{
    display:block;
    padding:12px 15px;
    margin-bottom:8px;
    color:#0f3d2e;
    text-decoration:none;
    border-radius:8px;
    font-size:14px;
}
.menu a:hover,.menu a.active{
    background:#fff;
    color:#2f7d5c;
    font-weight:600;
}

/* ===== MAIN ===== */
.main{flex:1;background:#fff;}
.topbar{
    display:flex;
    justify-content:space-between;
    align-items:center;
    padding:18px 30px;
    border-bottom:1px solid #eee;
}
.logout{
    background:#e53935;
    color:#fff;
    border:none;
    padding:7px 16px;
    border-radius:6px;
    cursor:pointer;
}

.content{padding:30px;}
.content h2{color:#2e7d32;margin-bottom:10px;}

.add-btn{
    margin-bottom:15px;
    display:inline-block;
    background:#2b8cff;
    color:#fff;
    padding:8px 14px;
    border-radius:6px;
    text-decoration:none;
    font-size:13px;
}

.table-box{
    border:1px solid #4c7dff;
    border-radius:4px;
    overflow:hidden;
}
table{width:100%;border-collapse:collapse;font-size:13px;}
th,td{padding:10px;border-bottom:1px solid #eaeaea;text-align:left;}
th{background:#f6f8ff;font-weight:600;}

.action .edit{
    background:#2ecc71;color:#fff;
    padding:4px 10px;border-radius:4px;
    text-decoration:none;font-size:12px;
}
.action .delete{
    background:#e74c3c;color:#fff;
    padding:4px 10px;border-radius:4px;
    text-decoration:none;font-size:12px;margin-left:5px;
}
</style>
</head>
<body>

<div class="wrapper">
<?php include "sidebar_admin.php"; ?>

<div class="main">
    <div class="topbar">
        <h3>Kelola Bobot Kriteria</h3>
        <form action="logout.php" method="post">
            <button class="logout">Logout</button>
        </form>
    </div>

    <div class="content">
        <a href="tambah_bobot.php" class="add-btn">+ Tambah Bobot</a>

        <div class="table-box">
            <table>
                <tr>
                    <th>No</th>
                    <th>Nama Kriteria</th>
                    <th>Bobot</th>
                    <th>Aksi</th>
                </tr>
                <?php $no=1; while($d=mysqli_fetch_assoc($query)): ?>
                <tr>
                    <td class="center"><?= $no++ ?></td>
                    <td><?= htmlspecialchars($d['nama_kriteria']) ?></td>
                    <td class="center"><?= $d['bobot'] ?></td>
                    <td class="center action">
                        <a href="edit_bobot.php?id=<?= $d['id'] ?>" class="edit">Edit</a>
                        <a href="hapus_bobot.php?id=<?= $d['id'] ?>" 
                           class="delete"
                           onclick="return confirm('Hapus bobot ini?')">Hapus</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </table>
        </div>
    </div>
</div>
</div>

</body>
</html>