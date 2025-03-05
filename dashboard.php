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
    <title>Dashboard - Sistem Pengelolaan Zakat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: url('masjid.png') no-repeat center center fixed;
            background-size: cover;
        }
        .dashboard-container {
            max-width: 800px;
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
        <div class="dashboard-container text-center">
            <h2 style="color: goldenrod;">Dashboard Zakat</h2>
            <p>Selamat datang, <strong><?php echo $nama; ?></strong> (<?php echo $jenis_user; ?>)</p>
            
            <a href="zakat.php" class="btn btn-goldenrod w-100 mb-2">Kelola Zakat</a>
            <a href="profile.php" class="btn btn-goldenrod w-100 mb-2">Profil Saya</a>
            
            <div class="text-center mt-3">
                <a href="logout.php" class="btn btn-danger">Logout</a>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
