<?php
session_start();
include "config.php";

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

$id = (int)$_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($conn,"
    SELECT * FROM bobot_kriteria WHERE id='$id'
"));

$kriteria = mysqli_query($conn,"SELECT * FROM kriteria");

if (!$data) {
    header("Location: kelola_bobot.php");
    exit;
}

if (isset($_POST['update'])) {
    $id_kriteria = (int)$_POST['id_kriteria'];
    $bobot = (float)$_POST['bobot'];

    mysqli_query($conn,"
        UPDATE bobot_kriteria SET
        id_kriteria='$id_kriteria',
        bobot='$bobot'
        WHERE id='$id'
    ");

    header("Location: kelola_bobot.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Edit Bobot</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
<style>
body{font-family:Poppins;background:#f4f7fa;}
.form-box{
    width:400px;margin:80px auto;background:#fff;
    padding:25px;border-radius:10px;
    box-shadow:0 4px 15px rgba(0,0,0,.1);
}
input,select,button{
    width:100%;padding:10px;margin-top:10px;
    border-radius:6px;border:1px solid #ccc;
}
button{background:#2ecc71;color:#fff;border:none;}
</style>
</head>
<body>

<div class="form-box">
<h3>Edit Bobot Kriteria</h3>
<form method="post">
<select name="id_kriteria" required>
<?php while($k=mysqli_fetch_assoc($kriteria)): ?>
<option value="<?= $k['id'] ?>"
<?= $k['id']==$data['id_kriteria']?'selected':'' ?>>
<?= $k['nama_kriteria'] ?>
</option>
<?php endwhile; ?>
</select>

<input type="number" step="0.01" name="bobot" value="<?= $data['bobot'] ?>" required>
<button name="update">Update</button>
</form>
</div>

</body>
</html>
