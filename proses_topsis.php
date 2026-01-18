<?php
session_start();
include "config.php";

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

// Ambil data alternatif dari riwayat_penilaian
$query_alt = mysqli_query($conn, "SELECT * FROM riwayat_penilaian ORDER BY id ASC");
$alternatif = [];
while($row = mysqli_fetch_assoc($query_alt)){
    $alternatif[] = $row;
}

// Ambil bobot kriteria
$query_bobot = mysqli_query($conn, "SELECT k.nama_kriteria, k.tipe, b.bobot 
    FROM bobot_kriteria b 
    JOIN kriteria k ON b.id_kriteria = k.id
    ORDER BY b.id ASC");
$bobot = [];
while($row = mysqli_fetch_assoc($query_bobot)){
    $bobot[] = $row;
}

$n_alt = count($alternatif);
$n_krit = count($bobot);

// Matriks keputusan
$matrik = [];
foreach($alternatif as $a){
    $matrik[] = [
        'pendapatan' => (float)$a['pendapatan'],
        'anggota' => (float)$a['anggota'],
        'pendidikan' => (float)$a['pendidikan'],
        'kondisi_rumah' => (float)$a['kondisi_rumah'],
        'aset' => (float)$a['aset']
    ];
}

// Normalisasi
$normalisasi = [];
$kriteria_keys = array_keys($matrik[0]);
foreach($kriteria_keys as $key){
    $sum_sq = 0;
    foreach($matrik as $row){
        $sum_sq += pow($row[$key],2);
    }
    $sqrt_sum = ($sum_sq>0) ? sqrt($sum_sq) : 1;
    foreach($matrik as $i => $row){
        $normalisasi[$i][$key] = $row[$key] / $sqrt_sum;
    }
}

// Matriks berbobot
$weighted = [];
foreach($normalisasi as $i => $row){
    foreach($kriteria_keys as $j => $key){
        $weighted[$i][$key] = $row[$key] * $bobot[$j]['bobot'];
    }
}

// Ideal positif & negatif
$ideal_pos = [];
$ideal_neg = [];
foreach($kriteria_keys as $j => $key){
    $col = array_column($weighted,$key);
    if($bobot[$j]['tipe']=='Benefit'){
        $ideal_pos[$key] = max($col);
        $ideal_neg[$key] = min($col);
    } else {
        $ideal_pos[$key] = min($col);
        $ideal_neg[$key] = max($col);
    }
}

// Hitung jarak & nilai akhir
$nilai_akhir = [];
for($i=0;$i<$n_alt;$i++){
    $sum_pos = 0;
    $sum_neg = 0;
    foreach($kriteria_keys as $key){
        $sum_pos += pow($weighted[$i][$key]-$ideal_pos[$key],2);
        $sum_neg += pow($weighted[$i][$key]-$ideal_neg[$key],2);
    }
    $d_pos = sqrt($sum_pos);
    $d_neg = sqrt($sum_neg);
    $nilai_akhir[$i] = ($d_pos+$d_neg>0) ? $d_neg/($d_pos+$d_neg) : 0;
}

// Ranking
$ranking = [];
$sorted = $nilai_akhir;
arsort($sorted);
$rank=1;
foreach($sorted as $i=>$val){
    $ranking[$i]=$rank++;
}

// Tentukan menu aktif
$current = basename($_SERVER['PHP_SELF']);
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Proses Perhitungan TOPSIS</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
<style>
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

/* ===== TABEL ===== */
table{
    width:100%;
    border-collapse:collapse;
    margin-top:10px;
    background:#fff;
    box-shadow:0 5px 15px rgba(0,0,0,0.05);
}
thead tr{
    background:#e8f5ee;
}
th, td{
    padding:10px 12px;
    border:1px solid #d6efe2;
}
th{
    font-weight:600;
    text-align:center;
    color:#1b3d2f;
}
td{
    text-align:center;
    font-size:14px;
    color:#333;
}
td.nama{
    text-align:left;
}
tbody tr:hover{
    background:#f9fdfb;
}
</style>

</head>
<body>
<div class="wrapper">
    <?php include "sidebar_admin.php"; ?>

    <div class="main">
        <div class="topbar">
            <div class="logo">
                <img src="logo.png" width="160">
            </div>
            <form method="post" action="logout.php">
                <button class="logout">Logout</button>
            </form>
        </div>

        <div class="content">
            <h2>Hasil Perhitungan TOPSIS</h2>

            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Skor</th>
                        <th>Ranking</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(!empty($nilai_akhir)): ?>
                        <?php $no=1; foreach($nilai_akhir as $i=>$nilai): ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td class="nama"><?= htmlspecialchars($alternatif[$i]['nama']) ?></td>
                            <td><?= number_format($nilai,4) ?></td>
                            <td><?= $ranking[$i] ?></td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="4" style="text-align:center;">Data belum tersedia</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>
