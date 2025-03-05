<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $jenis_user = $_POST['jenis_user'];

    $sql = "INSERT INTO users (nama, password, jenis_user) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $nama, $password, $jenis_user);
    
    if ($stmt->execute()) {
        $_SESSION['message'] = "Pendaftaran berhasil! Silakan login.";
        header("Location: login.php");
        exit();
    } else {
        $error = "Pendaftaran gagal, coba lagi!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Sistem Pengelolaan Zakat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: url('masjid.png') no-repeat center center fixed;
            background-size: cover;
        }
        .register-container {
            max-width: 400px;
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
        .login-box {
            background: rgba(255, 255, 255, 0.9);
            padding: 10px;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            text-align: center;
            margin-top: 15px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="register-container">
            <h2 class="text-center" style="color: goldenrod;">Register - Zakat</h2>
            <?php if (isset($error)) { echo "<div class='alert alert-danger'>$error</div>"; } ?>
            <form action="register.php" method="POST">
                <div class="mb-3">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" name="nama" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Jenis User</label>
                    <select name="jenis_user" class="form-control" required>
                        <option value="muzakki">Muzakki (Pemberi Zakat)</option>
                        <option value="mustahik">Mustahik (Penerima Zakat)</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-goldenrod w-100">Daftar</button>
            </form>
            <div class="login-box">
                <p class="mb-0">Sudah punya akun?</p>
                <a href="login.php" class="btn btn-goldenrod w-100">Login di sini</a>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
