<?php
session_start();

if (!isset($_SESSION['id_user']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Dashboard Admin | Sociacare</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
<style>
*{margin:0;padding:0;box-sizing:border-box;font-family:'Poppins',sans-serif;}
body{background:#f4f7fa;}
.wrapper{display:flex;min-height:100vh;}
.sidebar{
    width:260px;
    background:linear-gradient(180deg,#8ee0b0,#5ac89a);
    padding:20px;

    /* Sidebar sticky */
    position: fixed;
    top: 0;
    left: 0;
    height: 100vh;
    overflow-y: auto;
    z-index: 1000;
}
.profile{
    text-align:center;
    margin-bottom:30px;
}
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
.menu a:hover,.menu a.active{background:#fff;color:#2f7d5c;font-weight:600;}
.main{
    flex:1;
    background:#fff;
    margin-left:260px; /* supaya tidak tertutup sidebar */
}
.topbar{
    display:flex;
    justify-content:space-between;
    align-items:center;
    padding:20px 30px;
    border-bottom:1px solid #eee;
}
.logo{
    display:flex;align-items:center;gap:10px;font-weight:600;color:#2f7d5c;
}
.logout{
    background:#e53935;color:#fff;border:none;padding:8px 16px;
    border-radius:6px;cursor:pointer;font-size:13px;
}
.content {
    flex: 1;
    padding: 40px 60px;
    position: relative; /* supaya anak absolute posisinya relatif ke sini */
    min-height: 80vh;
}
h1 {
    font-size: 40px;
    margin-top: 60px;
    color: #0b331d;
}

/* ===== IMAGE TANGAN POJOK KANAN BAWAH ===== */
.image-box {
    position: absolute;
    right: 0;
    bottom: 0;
    margin: 20px; /* jarak dari tepi kanan dan bawah */
}

.hand-img {
    width: 300px;
    max-width: 100%;
}

/* RESPONSIVE */
@media(max-width:900px){
    .sidebar{
        width:100%;
        position: relative;
        height: auto;
        border-radius:0;
    }
    .main{
        margin-left:0;
    }
    .content{
        padding:20px;
    }
    .image-box{
        width: 150px; /* mengecilkan gambar di layar kecil */
        position: relative;
        right: auto;
        bottom: auto;
        margin:20px auto 0 auto;
        text-align:center;
    }
    .hand-img{
        width:100%;
    }
}
</style>
</head>

<body>
<div class="wrapper">
    <!-- INCLUDE SIDEBAR -->
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

        <!-- CONTENT -->
        <div class="content">
            <h1>
                Selamat Datang di Panel Admin<br>
                Sistem Pendukung Keputusan<br>
                Bantuan Sosial
            </h1>

            <div class="image-box">
                <img src="tangan.png.png" class="hand-img" alt="Tangan">
            </div>
        </div>
    </div>
</div>
</body>
</html>
