<?php
session_start();
include "config.php";

// proteksi user
if (!isset($_SESSION['id_user']) || $_SESSION['role'] !== 'user') {
    header("Location: login.php");
    exit;
}

$id_user = $_SESSION['id_user'];
$q = mysqli_query($conn, "SELECT * FROM users WHERE id_user='$id_user'");
$user = mysqli_fetch_assoc($q);

if (!$user) {
    die("Data user tidak ditemukan");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>SOCIACARE - Dashboard</title>

    <style>
        /* ===== RESET ===== */
        * {margin:0; padding:0; box-sizing:border-box; font-family:'Poppins',sans-serif;}
        a {text-decoration:none; color: inherit;}
        body {background:#f7f7f7; display:flex; overflow-x:hidden;}

        /* ===== SIDEBAR ===== */
        .sidebar {
            width: 270px;
            height: 100vh;
            background: linear-gradient(180deg, #8bd99c, #5bbb78);
            padding: 30px 20px;
            border-radius: 0 20px 20px 0;
            box-shadow: 2px 0 20px rgba(0,0,0,0.1);
        }

        .profile-card {
            text-align:center;
            margin-bottom:35px;
        }

        .profile-card img {
            width:90px;
            height:90px;
            border-radius:50%;
            background:#fff;
            padding:10px;
            border:2px solid #e0ffe9;
        }

        .profile-card p {
            margin-top:8px;
            font-weight:500;
        }

        .menu a {
            display:block;
            padding:14px 15px;
            margin-bottom:8px;
            font-size:16px;
            font-weight:500;
            color:#0f3d29;
            border-radius:8px;
            transition: background 0.3s;
        }

        .menu a:hover {
            background: rgba(255,255,255,0.8);
        }

        .menu .active {
            background:#ffffff;
            font-weight:600;
        }

        /* ===== CONTENT ===== */
        .content {
            flex:1;
            padding:40px 60px;
            position: relative;
        }

        .logo-area {
            display:flex;
            justify-content:space-between;
            align-items:center;
            margin-bottom:30px;
        }

        .logo-area img {
            height:150px;
            animation:none; /* animasi dimatikan */
        }

        .logout-btn {
            padding:10px 18px;
            background:#f56363;
            color:#fff;
            font-size:14px;
            border-radius:8px;
            font-weight:500;
            transition: background 0.3s;
        }

        .logout-btn:hover {
            background:#ff7b7b;
        }

        h1 {
            font-size:40px;
            margin-top:40px;
            color:#0b331d;
            animation:none; /* animasi dimatikan */
        }

        .image-box {
            position:absolute;
            right:40px;
            bottom:40px;
        }

        .hand-img {
            width:300px;
            animation:none; /* animasi dimatikan */
        }

        /* ===== MODAL ===== */
        .modal {
            display:none;
            position:fixed;
            top:0; left:0;
            width:100%;
            height:100%;
            background: rgba(0,0,0,0.5);
            z-index:999;
        }

        .modal-box {
            background:#fff;
            width:420px;
            margin:50px auto;
            padding:25px;
            border-radius:12px;
        }

        .close {
            position:absolute;
            right:15px;
            top:10px;
            font-size:22px;
            cursor:pointer;
        }

        .modal-box label {
            font-size:14px;
            margin-top:10px;
            display:block;
        }

        .modal-box input {
            width:100%;
            padding:10px;
            margin-top:5px;
            border-radius:8px;
            border:1px solid #ccc;
        }

        .modal-btn {
            margin-top:15px;
            display:flex;
            justify-content:flex-end;
            gap:10px;
        }

        .btn-save {
            background:#1e88e5;
            color:#fff;
            border:none;
            padding:8px 16px;
            border-radius:8px;
            cursor:pointer;
            transition: background 0.3s;
        }

        .btn-save:hover {
            background:#1565c0;
        }

        .btn-cancel {
            background:#ccc;
            border:none;
            padding:8px 16px;
            border-radius:8px;
            cursor:pointer;
            transition: background 0.3s;
        }

        .btn-cancel:hover {
            background:#b3b3b3;
        }

        #notif {
            margin-top:10px;
            font-size:14px;
            color:green;
        }

        /* ===== RESPONSIVE ===== */
        @media(max-width:900px){
            .sidebar{width:100%; border-radius:0;}
            .content{padding:20px;}
            .image-box{position:static; text-align:center; margin-top:20px;}
            .hand-img{width:200px;}
        }
    </style>
</head>

<body>
    <!-- SIDEBAR -->
    <div class="sidebar">
        <div class="profile-card">
            <img src="uploads/<?= htmlspecialchars($user['foto'] ?: 'default.png'); ?>" alt="Foto Profil">
            <p><?= htmlspecialchars($user['nama_lengkap']); ?></p>
            <p><a href="#" onclick="openModal()" style="color:#084421;">Edit Profil</a></p>
        </div>

        <div class="menu">
            <a href="dashboard.php" class="active">Dashboard</a>
            <a href="input_data.php">Input Data</a>
            <a href="penilaian_topsis.php">Penilaian TOPSIS</a>
            <a href="rekomendasi.php">Hasil Rekomendasi</a>
            <a href="riwayat.php">Riwayat</a>
            <a href="bantuan.php">Bantuan</a>
        </div>
    </div>

    <!-- CONTENT -->
    <div class="content">
        <div class="logo-area">
            <img src="logo.png" alt="SOCIACARE">
            <a href="logout.php" class="logout-btn">Logout</a>
        </div>

        <h1>
            Selamat Datang di<br>
            Sistem Pendukung Keputusan<br>
            Bantuan Sosial
        </h1>

        <div class="image-box">
            <img src="tangan.png.png" class="hand-img">
        </div>
    </div>

    <!-- MODAL EDIT PROFIL -->
    <div class="modal" id="modalProfil">
        <div class="modal-box">
            <span onclick="closeModal()" class="close">&times;</span>
            <h3>Edit Profil</h3>

            <form id="formProfil" enctype="multipart/form-data">
                <input type="hidden" name="id_user" value="<?= $user['id_user']; ?>">

                <label>Nama Lengkap</label>
                <input type="text" name="nama_lengkap" value="<?= htmlspecialchars($user['nama_lengkap']); ?>" required>

                <label>Email</label>
                <input type="email" name="email" value="<?= htmlspecialchars($user['email']); ?>" required>

                <label>Username</label>
                <input type="text" name="username" value="<?= htmlspecialchars($user['username']); ?>" required>

                <label>Foto Profil</label>
                <input type="file" name="foto">

                <label>Password Lama</label>
                <input type="password" name="password_lama">

                <label>Password Baru</label>
                <input type="password" name="password_baru">

                <div class="modal-btn">
                    <button type="button" class="btn-cancel" onclick="closeModal()">Batal</button>
                    <button type="submit" class="btn-save">Simpan</button>
                </div>

                <p id="notif"></p>
            </form>
        </div>
    </div>

    <script>
        function openModal(){ document.getElementById("modalProfil").style.display="block"; }
        function closeModal(){ document.getElementById("modalProfil").style.display="none"; }

        document.getElementById("formProfil").addEventListener("submit", function(e){
            e.preventDefault();
            let data = new FormData(this);

            fetch("proses_edit_profil_ajax.php", { method:"POST", body:data })
            .then(res => res.text())
            .then(res => {
                document.getElementById("notif").innerHTML = res;
                if(res.includes("berhasil")){
                    setTimeout(()=>location.reload(),1500);
                }
            });
        });
    </script>
</body>
</html>
