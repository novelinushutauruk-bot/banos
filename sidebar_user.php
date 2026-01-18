<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include "config.php";

// Proteksi halaman
if (!isset($_SESSION['id_user'])) {
    header("Location: login.php");
    exit;
}

$id_user = $_SESSION['id_user'];

$q = mysqli_query($conn, "SELECT * FROM users WHERE id_user='$id_user'");
$user = mysqli_fetch_assoc($q);

$currentPage = basename($_SERVER['PHP_SELF']);
?>

<style>
/* ===== Sidebar tetap diam saat scroll ===== */
.sidebar {
    position: fixed;   /* tetap di tempat saat scroll */
    top: 0;
    left: 0;
    height: 100vh;     /* tinggi penuh viewport */
    overflow-y: auto;  /* jika menu panjang, scroll di sidebar saja */
    width: 260px;      /* sesuaikan lebar sidebar */
    z-index: 1000;     /* pastikan di atas konten */
}

/* Konten utama harus diberi margin kiri agar tidak tertutup sidebar */
body > .main-content {
    margin-left: 260px; /* sama dengan lebar sidebar */
}
</style>

<div class="sidebar">
    <div class="profile-card">
        <img src="uploads/<?= htmlspecialchars($user['foto'] ?: 'default.png'); ?>" alt="Foto Profil">
        <p><?= htmlspecialchars($user['nama_lengkap']); ?></p>
        <p>
            <a href="#" onclick="openModal()" style="color:#084421;text-decoration:none;">
                Edit Profil
            </a>
        </p>
    </div>

    <div class="menu">
        <a href="dashboard.php" class="<?= ($currentPage=='dashboard.php')?'active':'' ?>">Dashboard</a>
        <a href="input_data.php" class="<?= ($currentPage=='input_data.php')?'active':'' ?>">Input Data</a>
        <a href="penilaian_topsis.php" class="<?= ($currentPage=='penilaian_topsis.php')?'active':'' ?>">Penilaian Topsis</a>
        <a href="rekomendasi.php" class="<?= ($currentPage=='rekomendasi.php')?'active':'' ?>">Hasil Rekomendasi</a>
        <a href="riwayat.php" class="<?= ($currentPage=='riwayat.php')?'active':'' ?>">Riwayat</a>
        <a href="bantuan.php" class="<?= ($currentPage=='bantuan.php')?'active':'' ?>">Bantuan</a>

        <!-- Tombol Logout -->
        <form action="logout.php" method="POST" style="margin-top:10px;">
            <button type="submit" name="logout" style="
                width:100%;
                padding:8px;
                background-color:#d9534f;
                color:#fff;
                border:none;
                border-radius:4px;
                cursor:pointer;
            ">
                Logout
            </button>
        </form>
    </div>
</div>
