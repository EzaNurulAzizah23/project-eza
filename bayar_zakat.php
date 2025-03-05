<?php
session_start();
include 'db.php';

if (!isset($_SESSION['nama']) || $_SESSION['jenis_user'] !== 'muzakki') {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_muzakki = $_SESSION['nama'];
    $jenis_zakat = $_POST['jenis_zakat'];
    $bentuk_zakat = $_POST['bentuk_zakat'];
    $jumlah = $_POST['jumlah'];
    $metode_pembayaran = $_POST['metode_pembayaran'];
    $tanggal_pembayaran = date('Y-m-d H:i:s');

    $sql = "INSERT INTO bayar_zakat (nama_muzakki, jenis_zakat, bentuk_zakat, jumlah, metode_pembayaran, tanggal_pembayaran) 
            VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssiss", $nama_muzakki, $jenis_zakat, $bentuk_zakat, $jumlah, $metode_pembayaran, $tanggal_pembayaran);
    
    if ($stmt->execute()) {
        $_SESSION['message'] = "Pembayaran zakat berhasil!";
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Pembayaran gagal, coba lagi!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bayar Zakat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: url('masjid.png') no-repeat center center fixed;
            background-size: cover;
        }
        .zakat-container {
            max-width: 500px;
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
            <h2 class="text-center" style="color: goldenrod;">Bayar Zakat</h2>
            <?php if (isset($error)) { echo "<div class='alert alert-danger'>$error</div>"; } ?>
            <form action="bayar_zakat.php" method="POST">
                <div class="mb-3">
                    <label class="form-label">Jenis Zakat</label>
                    <select name="jenis_zakat" id="jenis_zakat" class="form-control" required>
                        <option value="zakat_fitrah">Zakat Fitrah</option>
                        <option value="zakat_mal">Zakat Mal</option>
                    </select>
                </div>
                <div class="mb-3" id="bentuk_zakat_container">
                    <label class="form-label">Bentuk Zakat</label>
                    <select name="bentuk_zakat" id="bentuk_zakat" class="form-control">
                        <option value="uang">Uang</option>
                        <option value="beras">Beras (Kg)</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Jumlah</label>
                    <input type="number" name="jumlah" id="jumlah" class="form-control" required>
                    <small id="jumlah_label">Masukkan jumlah dalam Rupiah</small>
                </div>
                <div class="mb-3">
                    <label class="form-label">Metode Pembayaran</label>
                    <select name="metode_pembayaran" class="form-control" required>
                        <option value="transfer_bank">Transfer Bank</option>
                        <option value="e-wallet">E-Wallet</option>
                        <option value="tunai">Tunai</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-goldenrod w-100">Bayar</button>
            </form>
            <div class="text-center mt-3">
                <a href="dashboard.php" class="btn btn-secondary">Kembali ke Dashboard</a>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('jenis_zakat').addEventListener('change', function () {
            let bentukContainer = document.getElementById('bentuk_zakat_container');
            let jumlahInput = document.getElementById('jumlah');
            let jumlahLabel = document.getElementById('jumlah_label');

            if (this.value === 'zakat_fitrah') {
                bentukContainer.style.display = 'block';
            } else {
                bentukContainer.style.display = 'none';
                jumlahInput.placeholder = "Masukkan jumlah dalam Rupiah";
                jumlahLabel.innerText = "Masukkan jumlah dalam Rupiah";
            }
        });

        document.getElementById('bentuk_zakat').addEventListener('change', function () {
            let jumlahInput = document.getElementById('jumlah');
            let jumlahLabel = document.getElementById('jumlah_label');

            if (this.value === 'beras') {
                jumlahInput.placeholder = "Masukkan jumlah dalam Kg";
                jumlahLabel.innerText = "Masukkan jumlah dalam Kg";
            } else {
                jumlahInput.placeholder = "Masukkan jumlah dalam Rupiah";
                jumlahLabel.innerText = "Masukkan jumlah dalam Rupiah";
            }
        });

        // Jalankan event default saat halaman dimuat
        document.getElementById('jenis_zakat').dispatchEvent(new Event('change'));
    </script>
</body>
</html>
