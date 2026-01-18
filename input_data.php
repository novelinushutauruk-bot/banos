<?php
// DETEKSI HALAMAN
$currentPage = basename($_SERVER['PHP_SELF']);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>SOCIACARE - Input Data</title>

    <style>
        body {
            margin: 0;
            font-family: "Poppins", sans-serif;
            background: #f7f7f7;
        }

        /* SIDEBAR FULL */
        .sidebar {
            width: 270px;
            background: linear-gradient(180deg, #8bd99c, #5bbb78);
            padding: 30px 20px;
            box-sizing: border-box;
            border-radius: 0 20px 20px 0;
            box-shadow: 2px 0 20px rgba(0, 0, 0, 0.1);

            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            overflow-y: auto;
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
            transition: 0.3s ease;
        }

        .menu a:hover {
            background: rgba(255, 255, 255, 0.7);
            transform: translateX(6px);
        }

        /* MENU AKTIF */
        .menu .active {
            background: #ffffff;
            font-weight: 600;
            color: #0f3d29;
        }

        /* CONTENT */
        .content {
            padding: 40px 60px;
            margin-left: 270px;
        }

        .logo-area img {
            height: 150px;
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
            font-size: 36px;
            color: #0b331d;
            margin-bottom: 20px;
        }

        /* FORM */
        .form-container {
            width: 70%;
            background: #ffffff;
            padding: 25px 30px;
            border-radius: 15px;
            box-shadow: 0 6px 18px rgba(0,0,0,0.1);
            margin-top: 30px;
        }

        .form-group {
            margin-bottom: 18px;
        }

        .form-group label {
            display: block;
            margin-bottom: 6px;
            font-weight: 600;
            color: #0f3d29;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 12px;
            border: 2px solid #ccebd6;
            border-radius: 10px;
            font-size: 15px;
        }

        .submit-btn {
            width: 100%;
            padding: 14px;
            background: #5bbb78;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            color: #fff;
            cursor: pointer;
            font-weight: 600;
            transition: 0.2s;
            margin-top: 10px;
        }

        .submit-btn:hover {
            background: #479c63;
        }

    </style>
</head>

<body>

    <!-- SIDEBAR -->
    <?php include "sidebar_user.php"; ?>

    <!-- CONTENT -->
    <div class="content">

        <div class="logo-area">
            <img src="logo.png" alt="SOCIACARE">
            <a href="logout.php" class="logout-btn">Logout</a>
        </div>

        <h1>Input Data Warga</h1>

        <div class="form-container">

            <form action="proses_input.php" method="POST">

                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input type="text" name="nama" required>
                </div>

                <div class="form-group">
                    <label>Alamat</label>
                    <input type="text" name="alamat" required>
                </div>

                <div class="form-group">
                    <label>Penghasilan (per bulan)</label>
                    <input type="number" name="penghasilan" required>
                </div>

                <div class="form-group">
                    <label>Tanggungan Keluarga</label>
                    <input type="number" name="tanggungan" required>
                </div>

                <div class="form-group">
                    <label>Status Rumah</label>
                    <select name="status_rumah" required>
                        <option value="">-- Pilih --</option>
                        <option value="Sewa">Sewa</option>
                        <option value="Kontrak">Kontrak</option>
                        <option value="Milik Sendiri">Milik Sendiri</option>
                        <option value="Menumpang">Menumpang</option>
                    </select>
                </div>

                <button type="submit" name="submit" class="submit-btn">Simpan Data</button>

            </form>

        </div>

    </div>

</body>
</html>
