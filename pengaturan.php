<?php
require_once "config.php";

// simpan setting
function save_setting($name, $value) {
    global $conn;
    $stmt = $conn->prepare("
        INSERT INTO settings (name,value)
        VALUES (?,?)
        ON DUPLICATE KEY UPDATE value=VALUES(value)
    ");
    $stmt->bind_param("ss", $name, $value);
    $stmt->execute();
}

// proses form (ANTI LOOP)
if (isset($_POST['save'])) {

    $theme = ($_POST['theme']=='dark') ? 'dark' : 'light';

    $fonts = [
        'Arial, sans-serif',
        'Tahoma, sans-serif',
        'Verdana, sans-serif',
        "'Courier New', monospace"
    ];
    $font_family = in_array($_POST['font_family'],$fonts)
        ? $_POST['font_family']
        : 'Arial, sans-serif';

    $font_size = preg_match('/^\d+(px|em|rem)$/', $_POST['font_size'])
        ? $_POST['font_size']
        : '16px';

    save_setting('theme', $theme);
    save_setting('font_family', $font_family);
    save_setting('font_size', $font_size);

    header("Location: pengaturan.php?saved=1");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Pengaturan</title>
<style>
body{
    background: <?= $bg_color ?>;
    color: <?= $text_color ?>;
    font-family: <?= $font_family ?>;
}
.card{
    background: <?= $card_color ?>;
    padding:30px;
    max-width:500px;
    margin:50px auto;
}
button{
    background: <?= $btn_color ?>;
    color:#fff;
    border:none;
    padding:10px;
}
</style>
</head>
<body>

<div class="card">
<h2>Pengaturan Website</h2>

<?php if(isset($_GET['saved'])): ?>
<p style="color:green;">Pengaturan tersimpan ✅</p>
<?php endif; ?>

<form method="post">
<label>Tema</label>
<select name="theme">
    <option value="light" <?= $theme=='light'?'selected':'' ?>>Light</option>
    <option value="dark" <?= $theme=='dark'?'selected':'' ?>>Dark</option>
</select>

<label>Font</label>
<select name="font_family">
    <option value="Arial, sans-serif">Arial</option>
    <option value="Tahoma, sans-serif">Tahoma</option>
    <option value="Verdana, sans-serif">Verdana</option>
    <option value="'Courier New', monospace">Courier New</option>
</select>

<label>Ukuran Font</label>
<input type="text" name="font_size" value="<?= $font_size ?>">

<br><br>
<button name="save">Simpan</button>
</form>
</div>

</body>
</html>
