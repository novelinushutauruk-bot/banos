<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>SOCIACARE - Riwayat</title>
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

        table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 6px 18px rgba(0,0,0,0.1);
        }

        th, td {
            padding: 15px;
            text-align: left;
            font-size: 16px;
        }

        th {
            background: #8bd99c;
            color: #0b331d;
            font-weight: 600;
        }

        tr:nth-child(even) {
            background: #f2f2f2;
        }

        .status {
            padding: 5px 10px;
            border-radius: 12px;
            font-weight: 500;
            color: #fff;
            display: inline-block;
        }

        .status.direkomendasikan { background: #4CAF50; }
        .status.tidak { background: #F44336; }

    </style>
</head>
<body>

    <!-- Sidebar -->
    <?php include "sidebar_user.php"; ?>

    <!-- Content -->
    <div class="content">
        <a href="logout.php" class="logout-btn">Logout</a>
        <h1>Riwayat Data Anda</h1>

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal Daftar</th>
                    <th>Nama</th>
                    <th>Kategori</th>
                    <th>Skor TOPSIS</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>12-12-2025</td>
                    <td>Budi hartono</td>
                    <td>Tidak Mampu</td>
                    <td>0.72</td>
                    <td><span class="status direkomendasikan">Direkomendasikan</span></td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>10-12-2025</td>
                    <td>Bahlil puntra</td>
                    <td>Lansia</td>
                    <td>0.70</td>
                    <td><span class="status direkomendasikan">Direkomendasikan</span></td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>08-12-2025</td>
                    <td>kevin puan</td>
                    <td>Difabel</td>
                    <td>0.68</td>
                    <td><span class="status tidak">Tidak Direkomendasikan</span></td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>05-12-2025</td>
                    <td>wowok sitanggang</td>
                    <td>Tidak Mampu</td>
                    <td>0.65</td>
                    <td><span class="status tidak">Tidak Direkomendasikan</span></td>
                </tr>
            </tbody>
        </table>
    </div>

</body>
</html>
