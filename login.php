<?php session_start(); ?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login - SociaCare</title>
<style>
body {
    margin: 0;
    font-family: 'Poppins', sans-serif;
    background: #e8f7f1;
    height: 100vh;
    overflow: hidden;
    display: flex;
    justify-content: center;
    align-items: center;
}

/* CONTAINER */
.container {
    position: relative;
    width: 100%;
    height: 100%;
}

/* FORM LOGIN */
.login-box {
    width: 380px;
    background: white;
    padding: 35px;
    border-radius: 18px;
    box-shadow: 0 8px 25px rgba(0,0,0,0.2);
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%) scale(0.9);
    opacity: 0;
    z-index: 1;
    transition: opacity 0.8s ease, transform 0.8s ease;
}

.login-box.show {
    opacity: 1;
    transform: translate(-50%, -50%) scale(1);
}

/* PINTU / TIRAI KIRI & KANAN */
.door {
    position: absolute;
    top: 0;
    width: 50%;
    height: 100%;
    background: linear-gradient(180deg, #1abc9c, #16a085);
    z-index: 2;
}

/* pintu kiri */
.door.left {
    left: 0;
    animation: openLeft 1s forwards;
}

/* pintu kanan */
.door.right {
    right: 0;
    animation: openRight 1s forwards;
}

/* animasi tirai/pintu terbuka */
@keyframes openLeft {
    0% { transform: translateX(0); }
    100% { transform: translateX(-100%); }
}

@keyframes openRight {
    0% { transform: translateX(0); }
    100% { transform: translateX(100%); }
}

/* FORM STYLE */
.login-box h2 {
    text-align: center;
    color: #1a8f6f;
    font-weight: 700;
    margin-bottom: 15px;
}
.login-box p {
    text-align: center;
    color: #555;
    margin-top: -10px;
    font-size: 14px;
}
.input-group { margin-top: 20px; }
.input-group label { font-size: 14px; color: #333; font-weight: 500; }
.input-group input {
    width: 100%;
    padding: 12px;
    border-radius: 10px;
    border: 2px solid #d8e7e2;
    margin-top: 7px;
    font-size: 15px;
    transition: 0.3s;
}
.input-group input:focus {
    border-color: #1abc9c;
    outline: none;
    box-shadow: 0 0 8px rgba(26,188,156,0.4);
}
.btn-login {
    width: 100%;
    padding: 12px;
    margin-top: 25px;
    border: none;
    border-radius: 10px;
    background: #1abc9c;
    color: white;
    font-size: 16px;
    cursor: pointer;
    transition: 0.3s;
}
.btn-login:hover { background: #169f84; }
.daftar-link { text-align: center; margin-top: 15px; font-size: 14px; color: #333; }
.daftar-link a { color: #1abc9c; font-weight: 600; text-decoration: none; }
.daftar-link a:hover { text-decoration: underline; }

/* LOGO ATAS */
.logo { text-align: center; margin-bottom: 10px; }
.logo img { height: 55px; animation: floatLogo 2.2s infinite ease-in-out; }
@keyframes floatLogo {
    0% { transform: translateY(0); }
    50% { transform: translateY(-6px); }
    100% { transform: translateY(0); }
}
</style>
</head>
<body>

<div class="container">

    <!-- FORM LOGIN -->
    <div class="login-box" id="loginForm">

        <div class="logo">
            <img src="logo.png.png" alt="Logo">
        </div>

        <h2>Masuk ke SociaCare</h2>
        <p>Silakan masuk untuk melanjutkan</p>

        <form action="proses_login.php" method="POST">
            <div class="input-group">
                <label for="username">Username / Email</label>
                <input type="text" name="username" id="username" placeholder="Masukkan username" required>
            </div>
            <div class="input-group">
                <label for="password">Kata Sandi</label>
                <input type="password" name="password" id="password" placeholder="Masukkan kata sandi" required>
            </div>
            <button type="submit" class="btn-login">Masuk</button>

            <div class="daftar-link">
                Belum punya akun? <a href="daftar.php">Daftar sekarang</a>
            </div>
        </form>
    </div>

    <!-- PINTU / TIRAI -->
    <div class="door left"></div>
    <div class="door right"></div>

</div>

<script>
// Tampilkan form setelah tirai terbuka (1s)
window.addEventListener('load', () => {
    setTimeout(() => {
        document.getElementById('loginForm').classList.add('show');
    }, 1000);
});
</script>

</body>
</html>
