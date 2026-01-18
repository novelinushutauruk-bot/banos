<?php
session_start();
include "koneksi.php";

// Ambil data hasil TOPSIS dengan pengecekan error
$query = mysqli_query($conn, "SELECT * FROM hasil_rekomendasi ORDER BY nilai_akhir DESC");

if (!$query) {
    die("Query Error: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Hasil Rekomendasi</title>
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

        table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background: #8bd99c;
            color: #084421;
            font-weight: 600;
        }

        tr:hover {
            background: rgba(139, 217, 156, 0.3);
        }

        /* RESPONSIVE */
        @media (max-width: 768px) {
            .content {
                padding: 20px 30px;
            }

            table {
                font-size: 14px;
            }
        }

        @media (max-width: 480px) {
            table {
                font-size: 12px;
            }
        }
    </style>
</head>
<body>

    <!-- SIDEBAR -->
    <?php include "sidebar_user.php"; ?>

    <!-- CONTENT -->
    <div class="content">
        <div class="logo">
            <img src="logo.png" width="55">
            <h2>SOCIACARE</h2>
        </div>

        <h3>Hasil Rekomendasi Penerima Bantuan</h3>

        <?php
        if(mysqli_num_rows($query) > 0) {
        ?>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Penerima</th>
                    <th>Total Skor</th>
                    <th>Ranking</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                while($row = mysqli_fetch_assoc($query)) {
                    echo "<tr>";
                    echo "<td>".$no."</td>";
                    echo "<td>".$row['nama']."</td>";
                    echo "<td>".number_format($row['nilai_akhir'], 4)."</td>";
                    echo "<td>".$no."</td>";
                    echo "</tr>";
                    $no++;
                }
                ?>
            </tbody>
        </table>
        <?php
        } else {
            echo "<p>Belum ada data hasil rekomendasi.</p>";
        }
        ?>
    </div>

</body>
</html>
