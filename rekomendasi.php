<?php
session_start();
include "config.php";

// proteksi user
if (!isset($_SESSION['id_user']) || $_SESSION['role'] !== 'user') {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>SOCIACARE - Hasil Rekomendasi</title>
    <style>
        body {
            margin: 0;
            font-family: "Poppins", sans-serif;
            display: flex;
            background: #f7f7f7;
        }

        /* Sidebar */
        .sidebar {
            width: 270px;
            height: 100vh;
            background: linear-gradient(180deg, #8bd99c, #5bbb78);
            padding: 30px 20px;
            box-sizing: border-box;
            border-radius: 0 20px 20px 0;
            box-shadow: 2px 0 20px rgba(0,0,0,0.1);
            position: fixed;
            top: 0;
            left: 0;
            overflow: auto;
        }

        .profile-card {
            text-align: center;
            margin-bottom: 35px;
        }

        .profile-card img {
            width: 90px;
            height: 90px;
            border-radius: 50%;
            background: #fff;
            padding: 10px;
            border: 2px solid #e0ffe9;
        }

        .profile-card p {
            margin: 10px 0 0;
            font-weight: 500;
            color: #084421;
        }

        .menu {
            margin-top: 20px;
        }

        .menu a {
            display: block;
            padding: 14px 15px;
            margin-bottom: 8px;
            text-decoration: none;
            font-size: 16px;
            font-weight: 500;
            color: #0f3d29;
            border-radius: 8px;
            transition: 0.3s ease-in-out;
        }

        .menu a:hover {
            background: rgba(255,255,255,0.7);
            transform: translateX(6px);
        }

        .menu .active {
            background: #ffffff;
            font-weight: 600;
        }

        /* Content */
        .content {
            margin-left: 270px;
            flex: 1;
            padding: 40px 60px;
            position: relative;
        }

        .logout-btn {
            float: right;
            padding: 10px 18px;
            background: #f56363;
            color: #fff;
            font-size: 14px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 500;
            transition: 0.2s;
        }

        .logout-btn:hover {
            background: #e63b3b;
        }

        h1 {
            font-size: 32px;
            color: #0b331d;
            margin-bottom: 30px;
        }

        .card {
            background: #fff;
            padding: 20px 25px;
            border-radius: 15px;
            box-shadow: 0 6px 18px rgba(0,0,0,0.1);
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .card .no {
            font-size: 22px;
            font-weight: 700;
            color: #0b331d;
            width: 40px;
            text-align: center;
        }

        .card .info {
            margin-left: 20px;
            flex: 1;
        }

        .card .info h2 {
            margin: 0;
            font-size: 20px;
            color: #0b331d;
        }

        .card .info p {
            margin: 5px 0;
            font-size: 16px;
            color: #1c3d27;
        }

        .status {
            display: inline-block;
            padding: 5px 12px;
            border-radius: 12px;
            font-size: 14px;
            font-weight: 500;
            color: #fff;
            margin-top: 5px;
        }

        .status.direkomendasikan { background: #4CAF50; }
        .status.tidak { background: #F44336; }

        .user-position {
            font-size: 14px;
            font-weight: 500;
            color: #0b331d;
            margin-left: 20px;
            white-space: nowrap;
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <?php include "sidebar_user.php"; ?>

    <!-- Content -->
    <div class="content">
        <a href="logout.php" class="logout-btn">Logout</a>
        <h1>Hasil Rekomendasi Teratas</h1>

        <div class="card">
            <div class="no">1</div>
            <div class="info">
                <h2>Nama: Siti Aminah</h2>
                <p>Alamat: Bandung</p>
                <p>Kategori: Difabel</p>
                <p>Skor TOPSIS: 0.95 / Peringkat: 1</p>
                <span class="status direkomendasikan">Direkomendasikan</span>
            </div>
        </div>

        <div class="card">
            <div class="no">2</div>
            <div class="info">
                <h2>Nama: Budi Rahman</h2>
                <p>Alamat: Surabaya</p>
                <p>Kategori: Miskin</p>
                <p>Skor TOPSIS: 0.90 / Peringkat: 2</p>
                <span class="status direkomendasikan">Direkomendasikan</span>
            </div>
        </div>

        <div class="card">
            <div class="no">3</div>
            <div class="info">
                <h2>Nama: Ahmad Santoso</h2>
                <p>Alamat: Jakarta</p>
                <p>Kategori: Lansia</p>
                <p>Skor TOPSIS: 0.88 / Peringkat: 3</p>
                <span class="status direkomendasikan">Direkomendasikan</span>
            </div>
        </div>

        <div class="card">
            <div class="no">4</div>
            <div class="info">
                <h2>Nama: Lina Permata</h2>
                <p>Alamat: Yogyakarta</p>
                <p>Kategori: Difabel</p>
                <p>Skor TOPSIS: 0.85 / Peringkat: 4</p>
                <span class="status direkomendasikan">Direkomendasikan</span>
            </div>
        </div>

        <div class="card">
            <div class="no">5</div>
            <div class="info">
                <h2>Nama: Rudi Hartono</h2>
                <p>Alamat: Semarang</p>
                <p>Kategori: Miskin</p>
                <p>Skor TOPSIS: 0.80 / Peringkat: 5</p>
                <span class="status direkomendasikan">Direkomendasikan</span>
            </div>
        </div>

        <div class="card">
            <div class="no">10</div>
            <div class="info">
                <h2>Nama: User Anda</h2>
                <p>Alamat: Kota Anda</p>
                <p>Kategori: Miskin</p>
                <p>Skor TOPSIS: 0.72 / Peringkat: 10</p>
                <span class="status direkomendasikan">Direkomendasikan</span>
            </div>
            <div class="user-position">
                Anda terdaftar di posisi ke-10 dari 100 calon penerima
            </div>
        </div>

    </div>

</body>
</html>
