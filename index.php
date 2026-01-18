<?php ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SociaCare - Sistem Pendukung Bantuan Sosial</title>

    <!-- GOOGLE FONT -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

    <!-- ICON -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background: #f5f9f8;
        }

        /* NAVBAR */
        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 60px;
            background: white;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
            position: sticky;
            top: 0;
            z-index: 100;
            animation: fadeDown 1s;
        }

        nav a {
            margin-left: 25px;
            text-decoration: none;
            color: #333;
            font-weight: 500;
            transition: 0.3s;
        }

        nav a:hover {
            color: #1abc9c;
        }

        /* LOGO */
        .logo img {
            height: 45px;
            margin-right: 10px;
            animation: floatLogo 2.5s ease-in-out infinite;
        }

        @keyframes floatLogo {
            0% { transform: translateY(0); }
            50% { transform: translateY(-5px); }
            100% { transform: translateY(0); }
        }

        /* HERO SECTION */
        .hero {
            text-align: center;
            padding: 80px 20px;
            background: #e8f7f1;
            animation: fadeUp 1.2s;
        }

        .hero h1 {
            color: #1a8f6f;
            font-size: 34px;
            font-weight: 700;
        }

        .hero p {
            color: #333;
            font-size: 18px;
            margin-top: -10px;
        }

        /* BUTTON */
        .hero a {
            text-decoration: none;
        }

        .hero button {
            margin: 15px;
            padding: 12px 30px;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            font-size: 16px;
            transition: 0.3s;
        }

        .btn-green {
            background: #1abc9c;
            color: white;
        }

        .btn-green:hover {
            background: #169f84;
        }

        .btn-outline {
            background: white;
            border: 2px solid #1abc9c;
            color: #1abc9c;
        }

        .btn-outline:hover {
            background: #1abc9c;
            color: white;
        }

        /* CARD MENU */
        .menu-container {
            display: flex;
            justify-content: center;
            gap: 25px;
            margin-top: 40px;
            padding: 20px;
            animation: fadeUp 1.5s;
        }

        .card {
            width: 260px;
            background: white;
            padding: 25px;
            text-align: center;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            transition: 0.3s;
            cursor: pointer;
        }

        .card:hover {
            transform: translateY(-8px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.15);
        }

        .card i {
            font-size: 40px;
            color: #1abc9c;
            margin-bottom: 15px;
        }

        .card h3 {
            font-size: 18px;
            color: #1a8f6f;
            font-weight: 600;
        }

        .card p {
            font-size: 14px;
            color: #555;
        }

        /* ANIMATIONS */
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(30px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        @keyframes fadeDown {
            from { opacity: 0; transform: translateY(-20px); }
            to   { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>

    <!-- NAVBAR -->
    <nav>
        <div class="logo" style="display:flex; align-items:center;">
            <img src="logo.png.png" alt="Logo">
            <span style="font-size:22px; font-weight:700; color:#1abc9c;">SOCIACARE</span>
        </div>

        <div>
            <a href="#">Beranda</a>
            <a href="#">Input Data</a>
            <a href="#">Topsis</a>
            <a href="#">Hasil</a>
            <a href="#">Riwayat</a>
        </div>
    </nav>

    <!-- HERO SECTION -->
    <div class="hero">
        <h1>Selamat Datang di SociaCare<br>Sistem Pendukung Penerima Bantuan Sosial</h1>
        <p>Mulai Temukan Bantuan Sosial yang Tepat untuk Anda</p>

        <!-- TOMBOL KE HALAMAN LAIN -->
        <a href="login.php"><button class="btn-green">Masuk</button></a>
        <a href="daftar.php"><button class="btn-outline">Daftar</button></a>
    </div>

    <!-- MENU SECTION -->
    <div class="menu-container">
        <div class="card">
            <i class="fa-solid fa-file-pen"></i>
            <h3>Input Data Keluarga</h3>
            <p>Mengelola Data Warga dan Verifikasi penerima bantuan sosial</p>
        </div>

        <div class="card">
            <i class="fa-solid fa-calculator"></i>
            <h3>Perhitungan Topsis</h3>
            <p>Mengolah Kriteria Untuk Menentukan Prioritas Secara Objektif</p>
        </div>

        <div class="card">
            <i class="fa-solid fa-list-check"></i>
            <h3>Hasil Rekomendasi</h3>
            <p>Daftar Keluarga Yang Memenuhi Kriteria Penerima Bantuan</p>
        </div>

        <div class="card">
            <i class="fa-solid fa-clock-rotate-left"></i>
            <h3>Riwayat Tampilan</h3>
            <p>Melihat riwayat proses penilaian bantuan secara lengkap</p>
        </div>
    </div>

</body>
</html>
