<?php
// index.php - Halaman utama sistem pengelolaan zakat
include 'db.php';
session_start();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Pengelolaan Zakat</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Sistem Pengelolaan Zakat</h1>
    </header>
    <nav>
        <a href="index.php">Beranda</a>
        <a href="login.php">Login</a>
        <a href="register.php">Daftar</a>
    </nav>
    <main>
        <section>
            <h2>Apa Itu Sistem Pengelolaan Zakat?</h2>
            <p>Sistem ini membantu dalam pencatatan dan pengelolaan zakat secara transparan sesuai standar akuntansi.</p>
        </section>
    </main>
    <footer>
        <p>&copy; 2025 Masjid Jamie Al-Barkah</p>
    </footer>
</body>
</html>
