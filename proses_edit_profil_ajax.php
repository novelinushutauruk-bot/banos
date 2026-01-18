<?php
session_start();
include "config.php";

$id_user   = $_SESSION['id_user'];
$nama      = mysqli_real_escape_string($conn, $_POST['nama_lengkap']);
$email     = mysqli_real_escape_string($conn, $_POST['email']);
$username  = mysqli_real_escape_string($conn, $_POST['username']);
$pass_lama = $_POST['password_lama'];
$pass_baru = $_POST['password_baru'];

/* AMBIL DATA USER */
$q = mysqli_query($conn, "SELECT * FROM users WHERE id_user='$id_user'");
$user = mysqli_fetch_assoc($q);

/* PASSWORD */
$password_sql = "";
if (!empty($pass_baru)) {
    if (!password_verify($pass_lama, $user['password'])) {
        echo "❌ Password lama salah";
        exit;
    }
    $password_sql = ", password='".password_hash($pass_baru, PASSWORD_DEFAULT)."'";
}

/* FOTO */
$foto_sql = "";
if (!empty($_FILES['foto']['name'])) {
    $ext = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
    $nama_foto = "user_".$id_user.".".$ext;
    move_uploaded_file($_FILES['foto']['tmp_name'], "uploads/".$nama_foto);
    $foto_sql = ", foto='$nama_foto'";
}

/* UPDATE */
mysqli_query($conn, "
    UPDATE users SET
    nama_lengkap='$nama',
    email='$email',
    username='$username'
    $password_sql
    $foto_sql
    WHERE id_user='$id_user'
");

echo "✅ Profil berhasil diperbarui";
