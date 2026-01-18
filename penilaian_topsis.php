<?php
session_start();
include "config.php";

// proteksi user
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'user') {
    header("Location: login.php");
    exit;
}

// PROSES SIMPAN DATA
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $pendapatan = (int) $_POST['pendapatan'];
    $anggota = (int) $_POST['anggota'];
    $kondisi_rumah = (int) $_POST['rumah'];
    $pendidikan = (int) $_POST['pendidikan'];
    $aset = (int) $_POST['aset'];

    // SIMPAN KE TABEL ADMIN
    $sql = mysqli_query($conn, "
        INSERT INTO riwayat_penilaian
        (nama, pendapatan, anggota, kondisi_rumah, pendidikan, aset)
        VALUES
        ('$nama', '$pendapatan', '$anggota', '$kondisi_rumah', '$pendidikan', '$aset')
    ");

    if ($sql) {
        echo "<script>alert('Data berhasil disimpan dan masuk ke admin');</script>";
    } else {
        echo "<script>alert('Gagal menyimpan data');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Penilaian Topsis</title>
    <style>
        body {
            margin: 0;
            font-family: "Poppins", sans-serif;
            background: #f4f4f4;
            display: flex;
        }

        /* SIDEBAR */
        .sidebar {
            width: 270px;
            height: 100vh;
            background: linear-gradient(180deg, #8bd99c, #5bbb78);
            padding: 30px 20px;
            box-sizing: border-box;
            border-radius: 0 20px 20px 0;
            box-shadow: 2px 0 20px rgba(0,0,0,0.1);
            position: fixed;
            left: 0;
            top: 0;
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
            margin-top: 10px;
            font-weight: 500;
            color: #084421;
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

        .menu .active {
            background: #ffffff;
            font-weight: 600;
        }

        /* CONTENT */
        .content {
            flex: 1;
            margin-left: 270px;
            padding: 40px 60px;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 30px;
        }

        h3 {
            margin-bottom: 20px;
            color: #0b331d;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 6px;
            font-size: 14px;
            font-weight: bold;
            color: #0b331d;
        }

        input, select {
            width: 90%;
            padding: 12px;
            border-radius: 6px;
            border: 1px solid #ccc;
            font-size: 14px;
        }

        .btn-simpan {
            padding: 10px 25px;
            background: #3DAA4A;
            color: white;
            border: none;
            float: right;
            border-radius: 6px;
            cursor: pointer;
            font-weight: bold;
        }

        .btn-simpan:hover {
            background: #2C8A38;
        }
    </style>
</head>

<body>

<!-- SIDEBAR -->
<?php include "sidebar_user.php"; ?>

<!-- CONTENT -->
<div class="content">

    <div class="logo">
        <img src="logo.png" width="200">
    </div>

    <h3>Form Penilaian Penerima Bantuan (TOPSIS)</h3>

    <form method="POST">

        <div class="form-group">
            <label>Nama Penerima</label>
            <input type="text" name="nama" required>
        </div>

        <div class="form-group">
            <label>Pendapatan (C1)</label>
            <select name="pendapatan" required>
                <option value="">-- Pilih --</option>
                <option value="1">< 500.000</option>
                <option value="2">500.000 - 1.000.000</option>
                <option value="3">1.000.000 - 2.000.000</option>
                <option value="4">> 2.000.000</option>
            </select>
        </div>

        <div class="form-group">
            <label>Jumlah Anggota Keluarga (C2)</label>
            <select name="anggota" required>
                <option value="">-- Pilih --</option>
                <option value="4">> 6 orang</option>
                <option value="3">4 - 6 orang</option>
                <option value="2">2 - 3 orang</option>
                <option value="1">1 orang</option>
            </select>
        </div>

        <div class="form-group">
            <label>Kondisi Rumah (C3)</label>
            <select name="rumah" required>
                <option value="">-- Pilih --</option>
                <option value="4">Tidak layak</option>
                <option value="3">Kurang layak</option>
                <option value="2">Cukup layak</option>
                <option value="1">Layak</option>
            </select>
        </div>

        <div class="form-group">
            <label>Pendidikan Kepala Keluarga (C4)</label>
            <select name="pendidikan" required>
                <option value="">-- Pilih --</option>
                <option value="4">Tidak sekolah</option>
                <option value="3">SD</option>
                <option value="2">SMP</option>
                <option value="1">SMA / Ke atas</option>
            </select>
        </div>

        <div class="form-group">
            <label>Kepemilikan Aset (C5)</label>
            <select name="aset" required>
                <option value="">-- Pilih --</option>
                <option value="4">Tidak punya aset</option>
                <option value="3">Punya 1 aset kecil</option>
                <option value="2">2 aset</option>
                <option value="1">> 2 aset</option>
            </select>
        </div>

        <button type="submit" class="btn-simpan">SIMPAN</button>

    </form>

</div>

</body>
</html>
