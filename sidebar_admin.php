<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include "config.php";

/* Proteksi admin */
if (!isset($_SESSION['id_user']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

/* Ambil data admin */
$id_user = $_SESSION['id_user'];
$q = mysqli_query($conn, "SELECT * FROM users WHERE id_user='$id_user'");
$admin = mysqli_fetch_assoc($q);

/* Deteksi halaman aktif */
$currentPage = basename($_SERVER['PHP_SELF']);
?>

<style>
/* ===== Sidebar ===== */
.sidebar {
    width: 260px;
    background: linear-gradient(180deg,#8ee0b0,#5ac89a);
    padding: 20px;

    /* Sticky sidebar */
    position: fixed;
    top: 0;
    left: 0;
    height: 100vh;
    overflow-y: auto; /* scroll di sidebar jika konten panjang */
}

/* Profil admin */
.profile {
    text-align: center;
    margin-bottom: 30px;
}
.profile img {
    width: 90px;
    height: 90px;
    border-radius: 50%;
    border: 3px solid #fff;
}
.profile h4 {
    margin-top: 10px;
    color: #1b3d2f;
}
.profile small {
    display: block;
    color: #0f3d2e;
}

/* Menu */
.menu a {
    display: block;
    padding: 12px;
    margin-bottom: 8px;
    color: #0f3d2e;
    text-decoration: none;
    border-radius: 8px;
}
.menu a.active, .menu a:hover {
    background: #fff;
    font-weight: 600;
}

/* ===== Main content ===== */
.main {
    margin-left: 260px; /* agar tidak tertutup sidebar */
    flex: 1;
    background: #fff;
    padding: 20px;
}
</style>

<div class="sidebar">
    <div class="profile">
        <img src="https://cdn-icons-png.flaticon.com/512/847/847969.png" alt="Admin">
        <h4><?= $_SESSION['username'] ?? 'Admin'; ?></h4>
        <small>Administrator</small>
    </div>

    <div class="menu">
        <a href="dashboard_admin.php" class="<?= ($currentPage=='dashboard.php')?'active':'' ?>">Dashboard</a>
        <a href="kelola_data_keluarga.php" class="<?= ($currentPage=='kelola_data_keluarga.php')?'active':'' ?>">Kelola Data Keluarga</a>
        <a href="kelola_kriteria.php" class="<?= ($currentPage=='kelola_kriteria.php')?'active':'' ?>">Kelola Kriteria Topsis</a>
        <a href="kelola_bobot.php" class="<?= ($currentPage=='kelola_bobot.php')?'active':'' ?>">Kelola Bobot Kriteria</a>
        <a href="kelola_alternatif.php" class="<?= ($currentPage=='kelola_alternatif.php')?'active':'' ?>">Kelola Nilai Alternatif</a>
        <a href="proses_topsis.php" class="<?= ($currentPage=='proses_topsis.php')?'active':'' ?>">Proses Perhitungan Topsis</a>
        <a href="rangking.php" class="<?= ($currentPage=='rangking.php')?'active':'' ?>">Hasil Ranking Penerima</a>
        <a href="statistik_laporan.php" class="<?= ($currentPage=='statistik_laporan.php')?'active':'' ?>">Statistik & Laporan</a>
    </div>
</div>
