<?php
session_start();
include 'db.php';

if (!isset($_SESSION['nama'])) {
    header("Location: login.php");
    exit();
}

$nama = $_SESSION['nama'];
$jenis_user = $_SESSION['jenis_user'];

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zakat - Sistem Pengelolaan Zakat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: url('masjid.png') no-repeat center center fixed;
            background-size: cover;
        }
        .zakat-container {
            max-width: 600px;
            margin: 50px auto;
            background: rgba(255, 255, 255, 0.9);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-top: 5px solid goldenrod;
        }
        .btn-goldenrod {
            background-color: goldenrod;
            color: white;
        }
        .btn-goldenrod:hover {
            background-color: darkgoldenrod;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="zakat-container">
            <h2 class="text-center" style="color: goldenrod;">Pengelolaan Zakat</h2>
            <p class="text-center">Selamat datang, <strong><?php echo $nama; ?></strong> (<?php echo $jenis_user; ?>)</p>
            
            <?php if ($jenis_user == 'muzakki') { ?>
                <a href="bayar_zakat.php" class="btn btn-goldenrod w-100">Bayar Zakat</a>
            <?php } elseif ($jenis_user == 'mustahik') { ?>
                <a href="terima_zakat.php" class="btn btn-goldenrod w-100">Terima Zakat</a>
            <?php } elseif ($jenis_user == 'admin') { ?>
                <a href="kelola_zakat.php" class="btn btn-goldenrod w-100">Kelola Zakat</a>
            <?php } ?>
            
            <div class="text-center mt-3">
                <a href="logout.php" class="btn btn-danger">Logout</a>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
