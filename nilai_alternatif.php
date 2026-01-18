<?php
session_start();
if(!isset($_SESSION['username'])){
    $_SESSION['username'] = "Admin";
}
$current = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>SOCIACARE - Nilai Alternatif</title>

<style>
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family: "Poppins", sans-serif;
}
body{
    background:#f4f7fa;
}

/* ===== LAYOUT ===== */
.wrapper{
    display:flex;
    min-height:100vh;
}

/* ===== SIDEBAR ===== */
.sidebar{
    width:260px;
    background:#9fe3b1;
    padding:25px 20px;
}

.profile{
    text-align:center;
    margin-bottom:30px;
}
.profile img{
    width:80px;
    height:80px;
    border-radius:10px;
    background:#fff;
    padding:10px;
}
.profile p{
    margin-top:8px;
    font-size:13px;
    color:#2d6a4f;
}

.menu a{
    display:block;
    padding:12px 15px;
    margin-bottom:6px;
    text-decoration:none;
    color:#000;
    border-radius:6px;
    font-size:14px;
}
.menu a.active,
.menu a:hover{
    background:#6fcf97;
    font-weight:600;
}

/* ===== CONTENT ===== */
.content{
    flex:1;
    background:#fff;
    padding:30px 40px;
}

/* ===== HEADER ===== */
.header{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:25px;
}
.header img{
    height:45px;
}
.logout{
    background:#d90429;
    color:#fff;
    padding:8px 18px;
    border-radius:6px;
    text-decoration:none;
    font-size:13px;
}

/* ===== SECTION ===== */
h2{
    color:#2d6a4f;
    margin-bottom:10px;
}
.section{
    margin-bottom:25px;
}

/* ===== TABLE ===== */
table{
    width:100%;
    border-collapse:collapse;
    font-size:13px;
}
th,td{
    border:1px solid #9db5ff;
    padding:8px 10px;
    text-align:center;
}
th{
    background:#f1f4ff;
    font-weight:600;
}
.left{
    text-align:left;
}
</style>
</head>

<body>

<div class="wrapper">

    <!-- SIDEBAR -->
    <div class="sidebar">
        <div class="profile">
            <img src="https://cdn-icons-png.flaticon.com/512/847/847969.png">
            <p>Edit Profil</p>
        </div>

        <div class="menu">
            <a href="dashboard.php">Dashboard</a>
            <a href="kelola_keluarga.php">Kelola Data Keluarga</a>
            <a href="kriteria.php">Kelola Kriteria Topsis</a>
            <a href="bobot.php">Kelola Bobot Kriteria</a>
            <a href="nilai_alternatif.php" class="active">Kelola Nilai Alternatif</a>
            <a href="proses_topsis.php">Proses Perhitungan Topsis</a>
            <a href="ranking.php">Hasil Ranking Penerima</a>
            <a href="laporan.php">Statistik & Laporan</a>
        </div>
    </div>

    <!-- CONTENT -->
    <div class="content">

        <div class="header">
            <img src="logo.png" alt="SOCIACARE">
            <a href="logout.php" class="logout">Logout</a>
        </div>

        <!-- NILAI ALTERNATIF -->
        <div class="section">
            <h2>Nilai Alternatif</h2>
            <table>
                <tr>
                    <th>No.</th>
                    <th class="left">Nama Keluarga</th>
                    <th>Pendapatan</th>
                    <th>Jumlah Anggota</th>
                    <th>Pendidikan</th>
                    <th>Kondisi Rumah</th>
                    <th>Aset</th>
                </tr>
                <tr>
                    <td>1</td>
                    <td class="left">Keluarga A</td>
                    <td>4</td>
                    <td>1</td>
                    <td>3</td>
                    <td>5</td>
                    <td>2</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td class="left">Keluarga B</td>
                    <td>5</td>
                    <td>3</td>
                    <td>4</td>
                    <td>3</td>
