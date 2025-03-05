<?php
session_start();
include 'db.php';

if (!isset($_SESSION['nama']) || $_SESSION['jenis_user'] !== 'admin') {
    header("Location: login.php");
    exit();
}

$query = "SELECT * FROM bayar_zakat";
$result = $conn->query($query);

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Zakat - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: url('masjid.png') no-repeat center center fixed;
            background-size: cover;
        }
        .admin-container {
            max-width: 900px;
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
        <div class="admin-container">
            <h2 class="text-center" style="color: goldenrod;">Kelola Zakat - Admin</h2>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama Muzakki</th>
                        <th>Jenis Zakat</th>
                        <th>Jumlah</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()) { ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['nama_muzakki']; ?></td>
                            <td><?php echo $row['jenis_zakat']; ?></td>
                            <td><?php echo $row['jumlah']; ?></td>
                            <td>
                                <a href="edit_zakat.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-goldenrod">Edit</a>
                                <a href="hapus_zakat.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus data ini?')">Hapus</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <a href="tambah_zakat.php" class="btn btn-goldenrod w-100">Tambah Zakat</a>
            <div class="text-center mt-3">
                <a href="dashboard.php" class="btn btn-secondary">Kembali ke Dashboard</a>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
