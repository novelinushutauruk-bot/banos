<?php
session_start();
include "config.php";

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

$id = (int)$_GET['id'];
$data = mysqli_query($conn, "SELECT * FROM riwayat_penilaian WHERE id=$id");
$row = mysqli_fetch_assoc($data);

if(isset($_POST['submit'])){
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $pendapatan = (int)$_POST['pendapatan'];
    $anggota = (int)$_POST['anggota'];
    $pendidikan = mysqli_real_escape_string($conn, $_POST['pendidikan']);
    $kondisi_rumah = mysqli_real_escape_string($conn, $_POST['kondisi_rumah']);
    $aset = mysqli_real_escape_string($conn, $_POST['aset']);

    mysqli_query($conn, "UPDATE riwayat_penilaian SET nama='$nama', pendapatan=$pendapatan, anggota=$anggota, pendidikan='$pendidikan', kondisi_rumah='$kondisi_rumah', aset='$aset' WHERE id=$id");
    header("Location: kelola_alternatif.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Edit Alternatif</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
<style>
/* Sama seperti tambah_alternatif.php */
*{margin:0;padding:0;box-sizing:border-box;font-family:'Poppins',sans-serif;}
body{background:#f4f7fa;}
.wrapper{display:flex;min-height:100vh;}
.sidebar{width:260px;background:linear-gradient(180deg,#8ee0b0,#5ac89a);padding:20px;}
.profile{text-align:center;margin-bottom:30px;}
.profile img{width:90px;height:90px;border-radius:50%;border:3px solid #fff;}
.profile h4{margin-top:10px;color:#1b3d2f;}
.menu a{display:block;padding:12px;margin-bottom:8px;color:#0f3d2e;text-decoration:none;border-radius:8px;}
.menu a.active,.menu a:hover{background:#fff;font-weight:600;}
.main{flex:1;background:#fff;}
.topbar{display:flex;justify-content:space-between;align-items:center;padding:18px 30px;border-bottom:1px solid #eee;}
.logout{background:#e53935;color:#fff;border:none;padding:7px 16px;border-radius:6px;cursor:pointer;}
.content{padding:25px;}
.content h2{color:#1b5e20;margin-bottom:20px;}
.form-box{background:#fff;padding:25px;border-radius:10px;box-shadow:0 8px 20px rgba(0,0,0,0.05);}
.form-box label{display:block;margin-bottom:6px;font-weight:600;}
.form-box input, .form-box select{width:100%;padding:10px 12px;margin-bottom:15px;border:1px solid #ccc;border-radius:6px;font-size:14px;}
.submit-btn{background:#2b8cff;color:#fff;padding:10px 16px;border:none;border-radius:8px;font-size:14px;cursor:pointer;}
.submit-btn:hover{background:#1f6fe0;}
</style>
</head>
<body>
<div class="wrapper">
<?php include "sidebar_admin.php"; ?>
<div class="main">
    <div class="topbar">
        <div class="logo"><img src="logo.png" width="160"></div>
        <form method="post" action="logout.php"><button class="logout">Logout</button></form>
    </div>

    <div class="content">
        <h2>Edit Alternatif</h2>
        <div class="form-box">
            <form method="post">
                <label>Nama</label>
                <input type="text" name="nama" value="<?= htmlspecialchars($row['nama']) ?>" required>

                <label>Pendapatan</label>
                <input type="number" name="pendapatan" value="<?= $row['pendapatan'] ?>" required>

                <label>Jumlah Anggota</label>
                <input type="number" name="anggota" value="<?= $row['anggota'] ?>" required>

                <label>Pendidikan</label>
                <select name="pendidikan" required>
                    <?php $options=['SD','SMP','SMA','Diploma','Sarjana']; 
                    foreach($options as $o){
                        $sel = $o==$row['pendidikan']?'selected':'';
                        echo "<option value='$o' $sel>$o</option>";
                    }?>
                </select>

                <label>Kondisi Rumah</label>
                <select name="kondisi_rumah" required>
                    <?php $options=['Layak','Kurang Layak']; 
                    foreach($options as $o){
                        $sel = $o==$row['kondisi_rumah']?'selected':'';
                        echo "<option value='$o' $sel>$o</option>";
                    }?>
                </select>

                <label>Aset</label>
                <select name="aset" required>
                    <?php $options=['Banyak','Sedikit']; 
                    foreach($options as $o){
                        $sel = $o==$row['aset']?'selected':'';
                        echo "<option value='$o' $sel>$o</option>";
                    }?>
                </select>

                <button type="submit" name="submit" class="submit-btn">Update</button>
            </form>
        </div>
    </div>
</div>
</div>
</body>
</html>
