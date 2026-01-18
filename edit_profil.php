<?php
session_start();
include "config.php";

/* contoh ambil data user login */
$id_user = $_SESSION['id_user'];

$data = mysqli_query($conn, "SELECT * FROM user WHERE id_user='$id_user'");
$user = mysqli_fetch_assoc($data);
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Edit Profil - SOCIACARE</title>

<style>
body{
    margin:0;
    font-family:Poppins,sans-serif;
    background:#f7f7f7;
}

/* SIDEBAR */
.sidebar{
    position:fixed;
    left:0;top:0;
    width:270px;
    height:100vh;
    background:linear-gradient(180deg,#8bd99c,#5bbb78);
    padding:30px 20px;
    box-shadow:2px 0 20px rgba(0,0,0,.1);
}

.menu a{
    display:block;
    padding:14px;
    margin-bottom:8px;
    text-decoration:none;
    color:#0f3d29;
    border-radius:8px;
}
.menu a:hover{background:#fff}

/* CONTENT */
.content{
    margin-left:270px;
    padding:40px;
}

/* FORM */
.card{
    background:#fff;
    max-width:500px;
    padding:25px;
    border-radius:15px;
    box-shadow:0 5px 15px rgba(0,0,0,.1);
}

label{font-size:14px;margin-top:10px;display:block}
input,textarea{
    width:100%;
    padding:10px;
    margin-top:5px;
    border-radius:8px;
    border:1px solid #ccc;
}

.btn{
    margin-top:20px;
    display:flex;
    justify-content:space-between;
}

.btn button{
    padding:10px 18px;
    border:none;
    border-radius:8px;
    cursor:pointer;
}

.simpan{background:#1e88e5;color:#fff}
.batal{background:#ccc}
</style>
</head>

<body>

<!-- SIDEBAR -->
<div class="sidebar">
    <div class="menu">
        <a href="dashboard.php">Dashboard</a>
        <a href="edit_profil.php" style="background:#fff;font-weight:600;">Edit Profil</a>
        <a href="logout.php">Logout</a>
    </div>
</div>

<!-- CONTENT -->
<div class="content">
    <h2>Edit Profil</h2>

    <div class="card">
        <form action="proses_edit_profil.php" method="POST" enctype="multipart/form-data">

            <input type="hidden" name="id_user" value="<?= $user['id_user'] ?>">

            <label>Nama Lengkap</label>
            <input type="text" name="nama" value="<?= $user['nama_lengkap'] ?>" required>

            <label>Email</label>
            <input type="email" name="email" value="<?= $user['email'] ?>" required>

            <label>Nomor Telepon</label>
            <input type="text" name="telepon" value="<?= $user['telepon'] ?>">

            <label>Alamat</label>
            <textarea name="alamat"><?= $user['alamat'] ?></textarea>

            <label>Foto Profil</label>
            <input type="file" name="foto">

            <label>Password Lama</label>
            <input type="password" name="password_lama">

            <label>Password Baru</label>
            <input type="password" name="password_baru">

            <div class="btn">
                <button type="button" class="batal" onclick="history.back()">Batal</button>
                <button type="submit" class="simpan">Simpan</button>
            </div>

        </form>
    </div>
</div>

</body>
</html>
