<?php
session_start();
include "config.php";

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

// Ambil data alternatif
$query_alt = mysqli_query($conn, "SELECT * FROM riwayat_penilaian ORDER BY id ASC");
$alternatif = [];
while($row = mysqli_fetch_assoc($query_alt)){
    $alternatif[] = $row;
}

// Statistik: Hitung jumlah keluarga per kategori pendapatan
$kategori_pendapatan = [
    'Rendah' => 0,
    'Sedang' => 0,
    'Tinggi' => 0
];

foreach($alternatif as $a){
    if($a['pendapatan'] <= 2000000){
        $kategori_pendapatan['Rendah']++;
    } elseif($a['pendapatan'] <= 5000000){
        $kategori_pendapatan['Sedang']++;
    } else {
        $kategori_pendapatan['Tinggi']++;
    }
}

// Unduh laporan CSV
if(isset($_GET['download']) && $_GET['download'] == 'csv'){
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment;filename="laporan_keluarga.csv"');
    $output = fopen('php://output', 'w');
    fputcsv($output, ['No','Nama','Pendapatan','Anggota','Pendidikan','Kondisi Rumah','Aset']);
    $no=1;
    foreach($alternatif as $a){
        fputcsv($output, [$no++, $a['nama'], $a['pendapatan'], $a['anggota'], $a['pendidikan'], $a['kondisi_rumah'], $a['aset']]);
    }
    fclose($output);
    exit;
}

// Tentukan menu aktif
$current = basename($_SERVER['PHP_SELF']);
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Statistik & Laporan</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
table{width:100%;border-collapse:collapse;table-layout: fixed;margin-top:10px;}
thead{background:#e8f5ee;}
th,td{padding:12px;font-size:14px;border:1px solid #ddd;text-align:center;}
td.nama{text-align:left;}
tbody tr:hover{background:#f9fdfb;}
.download-btn{display:inline-block;margin-bottom:15px;background:#2b8cff;color:#fff;padding:10px 16px;border-radius:8px;font-size:14px;text-decoration:none;}
.download-btn:hover{background:#1f6fe0;}
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
            <!-- Grafik Pendapatan (sebelumnya sudah ada) -->
            <h2>Statistik Pendapatan Keluarga</h2>
            <canvas id="pendapatanChart" width="400" height="200"></canvas>
            <button id="downloadChart" class="download-btn">Download Grafik</button>

            <!-- Grafik baru: Anggota -->
            <h2>Statistik Jumlah Anggota Keluarga</h2>
            <canvas id="anggotaChart" width="400" height="200"></canvas>
            <button id="downloadAnggota" class="download-btn">Download Grafik Anggota</button>

            <!-- Grafik baru: Pendidikan -->
            <h2>Statistik Pendidikan</h2>
            <canvas id="pendidikanChart" width="400" height="200"></canvas>
            <button id="downloadPendidikan" class="download-btn">Download Grafik Pendidikan</button>

            <!-- Grafik baru: Kondisi Rumah -->
            <h2>Statistik Kondisi Rumah</h2>
            <canvas id="rumahChart" width="400" height="200"></canvas>
            <button id="downloadRumah" class="download-btn">Download Grafik Rumah</button>

            <!-- Grafik baru: Aset -->
            <h2>Statistik Aset</h2>
            <canvas id="asetChart" width="400" height="200"></canvas>
            <button id="downloadAset" class="download-btn">Download Grafik Aset</button>

            <!-- Laporan CSV & tabel -->
            <h2 style="margin-top:40px;">Laporan Keluarga</h2>
            <a href="?download=csv" class="download-btn">Download CSV</a>

            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Pendapatan</th>
                        <th>Anggota</th>
                        <th>Pendidikan</th>
                        <th>Kondisi Rumah</th>
                        <th>Aset</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(!empty($alternatif)): ?>
                        <?php $no=1; foreach($alternatif as $a): ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td class="nama"><?= htmlspecialchars($a['nama']) ?></td>
                            <td><?= number_format($a['pendapatan'],0,',','.') ?></td>
                            <td><?= $a['anggota'] ?></td>
                            <td><?= $a['pendidikan'] ?></td>
                            <td><?= $a['kondisi_rumah'] ?></td>
                            <td><?= $a['aset'] ?></td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="7">Data belum tersedia</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
// Grafik Pendapatan (seperti sebelumnya)
const pendapatanChart = new Chart(document.getElementById('pendapatanChart').getContext('2d'), {
    type:'line',
    data:{
        labels: <?= json_encode(array_keys($kategori_pendapatan)) ?>,
        datasets:[{
            label:'Jumlah Keluarga',
            data: <?= json_encode(array_values($kategori_pendapatan)) ?>,
            borderColor:'#2b8cff',
            backgroundColor:'rgba(43,140,255,0.2)',
            fill:true,
            tension:0.3,
            pointBackgroundColor:'#2b8cff',
            pointRadius:5
        }]
    },
    options:{
        responsive:true,
        plugins:{legend:{display:false},title:{display:true,text:'Jumlah Keluarga per Pendapatan'}},
        scales:{y:{beginAtZero:true,precision:0}}
    }
});

// Grafik baru statik
const anggotaChart = new Chart(document.getElementById('anggotaChart').getContext('2d'), {
    type:'line',
    data:{
        labels:['1-3','4-6','7+'],
        datasets:[{label:'Jumlah Keluarga',data:[4,9,3],borderColor:'#28a745',backgroundColor:'rgba(40,167,69,0.2)',fill:true,tension:0.3,pointBackgroundColor:'#28a745',pointRadius:5}]
    },
    options:{responsive:true,plugins:{legend:{display:false},title:{display:true,text:'Jumlah Keluarga per Anggota'}},scales:{y:{beginAtZero:true,precision:0}}}
});

const pendidikanChart = new Chart(document.getElementById('pendidikanChart').getContext('2d'), {
    type:'line',
    data:{
        labels:['SD','SMP','SMA','Sarjana'],
        datasets:[{label:'Jumlah Keluarga',data:[3,4,5,4],borderColor:'#f39c12',backgroundColor:'rgba(243,156,18,0.2)',fill:true,tension:0.3,pointBackgroundColor:'#f39c12',pointRadius:5}]
    },
    options:{responsive:true,plugins:{legend:{display:false},title:{display:true,text:'Jumlah Keluarga per Pendidikan'}},scales:{y:{beginAtZero:true,precision:0}}}
});

const rumahChart = new Chart(document.getElementById('rumahChart').getContext('2d'), {
    type:'line',
    data:{
        labels:['Bagus','Sedang','Buruk'],
        datasets:[{label:'Jumlah Keluarga',data:[6,7,3],borderColor:'#e74c3c',backgroundColor:'rgba(231,76,60,0.2)',fill:true,tension:0.3,pointBackgroundColor:'#e74c3c',pointRadius:5}]
    },
    options:{responsive:true,plugins:{legend:{display:false},title:{display:true,text:'Jumlah Keluarga per Kondisi Rumah'}},scales:{y:{beginAtZero:true,precision:0}}}
});

const asetChart = new Chart(document.getElementById('asetChart').getContext('2d'), {
    type:'line',
    data:{
        labels:['Motor','Mobil','Elektronik','Lainnya'],
        datasets:[{label:'Jumlah Keluarga',data:[5,3,7,1],borderColor:'#8e44ad',backgroundColor:'rgba(142,68,173,0.2)',fill:true,tension:0.3,pointBackgroundColor:'#8e44ad',pointRadius:5}]
    },
    options:{responsive:true,plugins:{legend:{display:false},title:{display:true,text:'Jumlah Keluarga per Aset'}},scales:{y:{beginAtZero:true,precision:0}}}
});

// Fungsi download grafik
function setupDownload(btnId, chart){
    document.getElementById(btnId).addEventListener('click',function(){
        const link=document.createElement('a');
        link.href=chart.toBase64Image();
        link.download=btnId+'.png';
        link.click();
    });
}

// Tombol download
setupDownload('downloadChart', pendapatanChart);
setupDownload('downloadAnggota', anggotaChart);
setupDownload('downloadPendidikan', pendidikanChart);
setupDownload('downloadRumah', rumahChart);
setupDownload('downloadAset', asetChart);
</script>
</body>
</html>
