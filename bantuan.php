<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>SPK Pemilihan Penerima Bantuan Sosial - Bantuan</title>

    <style>
        body {
            margin: 0;
            font-family: "Poppins", sans-serif;
            background: #f7f7f7;
        }

        /* ===== SIDEBAR ===== */
        .sidebar {
            width: 270px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;

            background: linear-gradient(180deg, #8bd99c, #5bbb78);
            padding: 30px 20px;
            box-sizing: border-box;
            border-radius: 0 20px 20px 0;
            box-shadow: 2px 0 20px rgba(0,0,0,0.1);

            display: flex;
            flex-direction: column;
        }

        .profile-card {
            text-align: center;
            margin-bottom: 30px;
        }

        .profile-card img {
            width: 90px;
            height: 90px;
            border-radius: 50%;
            background: #fff;
            padding: 10px;
        }

        .profile-card p {
            margin-top: 10px;
            font-weight: 500;
            color: #084421;
        }

        .menu {
            flex: 1;
        }

        .menu a {
            display: block;
            padding: 14px 15px;
            margin-bottom: 8px;
            text-decoration: none;
            font-size: 15px;
            font-weight: 500;
            color: #0f3d29;
            border-radius: 8px;
            transition: 0.3s;
        }

        .menu a:hover {
            background: rgba(255,255,255,0.7);
            transform: translateX(6px);
        }

        .menu .active {
            background: #ffffff;
            font-weight: 600;
        }

        /* ===== CONTENT ===== */
        .content {
            margin-left: 270px;
            padding: 40px 60px;
            min-height: 100vh;
        }

        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .top-bar h1 {
            font-size: 28px;
            color: #0b331d;
            margin: 0;
        }

        .logout-btn {
            padding: 10px 18px;
            background: #f56363;
            color: #fff;
            text-decoration: none;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
        }

        .description {
            max-width: 750px;
            color: #2f4f3f;
            margin-bottom: 25px;
        }

        .search-box input {
            width: 100%;
            max-width: 500px;
            padding: 14px 18px;
            border-radius: 10px;
            border: 1px solid #cce7d6;
            font-size: 15px;
        }

        .help-box {
            background: #ffffff;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 6px 18px rgba(0,0,0,0.1);
            margin-top: 30px;
            line-height: 1.7;
            color: #1c3d27;
        }

        .help-box h2 {
            color: #0b331d;
            margin-top: 0;
        }

        .help-box p {
            margin-bottom: 12px;
        }

        .help-box ul {
            margin-left: 20px;
        }
    </style>
</head>

<body>

<!-- ===== SIDEBAR ===== -->
<?php include "sidebar_user.php"; ?>

<!-- ===== CONTENT ===== -->
<div class="content">

    <!-- HEADER -->
    <div class="top-bar">
        <h1>SPK Pemilihan Penerima Bantuan Sosial</h1>
        <a href="logout.php" class="logout-btn">Logout</a>
    </div>

    <p class="description">
        Temukan jawaban atas pertanyaan umum terkait pengajuan dan penilaian
        penerima bantuan sosial atau hubungi kami untuk bantuan lebih lanjut.
    </p>

    <!-- SEARCH -->
    <div class="search-box">
        <input type="text" placeholder="Cari pertanyaan, topik, atau kata kunci…">
    </div>

    <!-- AKUN & DATA -->
    <div class="help-box">
        <h2>Akun & Data Pribadi</h2>

        <p><strong>Bagaimana cara mengubah password akun?</strong></p>
        <p>Password dapat diubah melalui menu <strong>Data Pribadi</strong>.</p>

        <p><strong>Bagaimana cara memperbarui data pribadi?</strong></p>
        <p>Perbarui data agar proses penilaian TOPSIS berjalan akurat.</p>

        <p><strong>Bagaimana cara melengkapi data pendukung?</strong></p>
        <p>Pastikan seluruh data diisi dengan benar sebelum mengajukan bantuan.</p>
    </div>

    <!-- PENGAJUAN -->
    <div class="help-box">
        <h2>Pengajuan & Penilaian Bantuan Sosial</h2>

        <p><strong>Bagaimana cara mengajukan bantuan?</strong></p>
        <p>Gunakan menu <strong>Pengajuan Bantuan</strong> dan lengkapi data.</p>

        <p><strong>Bagaimana proses seleksi menggunakan TOPSIS?</strong></p>
        <p>Sistem menilai calon penerima berdasarkan kriteria dan bobot.</p>

        <p><strong>Bagaimana melihat hasil penilaian?</strong></p>
        <p>Hasil dan peringkat tersedia pada menu <strong>Hasil Penilaian</strong>.</p>

        <p><strong>Bagaimana mengecek status pengajuan?</strong></p>
        <p>Status dapat dipantau melalui menu <strong>Status Pengajuan</strong>.</p>
    </div>

    <!-- HUBUNGI KAMI -->
    <div class="help-box">
        <h2>Hubungi Kami</h2>
        <ul>
            <li>Email: spkbantuansosial@gmail.com</li>
            <li>Telepon: +62 812-3456-7890</li>
            <li>Senin–Jumat, 09.00–17.00 WIB</li>
        </ul>

        <p>
            <strong>Alamat:</strong><br>
            Kantor Dinas Sosial<br>
            Jl. Setia Budi No. 123, Kota Medan
        </p>
    </div>

</div>

</body>
</html>
