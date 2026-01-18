<div class="sidebar">
    <div class="profile-card">
        <img src="uploads/<?= $user['foto'] ?: 'default.png'; ?>" alt="User">
        <p>
            <a href="#" onclick="openModal()" style="color:#084421;text-decoration:none;">
                <?= htmlspecialchars($user['nama_lengkap']); ?>
            </a>
        </p>
    </div>

    <div class="menu">
        <a href="dashboard.php">Dashboard</a>
        <a href="input_data.php">Input Data</a>
        <a href="penilaian.php">Penilaian TOPSIS</a>
        <a href="rekomendasi.php">Hasil Rekomendasi</a>
        <a href="riwayat.php">Riwayat</a>
        <a href="bantuan.php">Bantuan</a>
    </div>
</div>
