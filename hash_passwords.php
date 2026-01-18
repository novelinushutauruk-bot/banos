<?php
include "config.php";

$result = mysqli_query($conn, "SELECT id_user, password FROM users");

while ($row = mysqli_fetch_assoc($result)) {
    $id = $row['id_user'];
    $pass = $row['password'];

    // Cek apakah sudah hash
    if (strlen($pass) < 60 || substr($pass,0,4) !== '$2y$') {
        $hash = password_hash($pass, PASSWORD_DEFAULT);
        mysqli_query($conn, "UPDATE users SET password='$hash' WHERE id_user='$id'");
        echo "User ID $id password di-hash.<br>";
    } else {
        echo "User ID $id sudah hash.<br>";
    }
}
?>
