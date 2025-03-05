<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $password = $_POST['password'];
    
    $sql = "SELECT * FROM users WHERE nama = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $nama);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['nama'] = $user['nama'];
            $_SESSION['jenis_user'] = $user['jenis_user'];
            header("Location: dashboard.php");
            exit();
        } else {
            $error = "Password salah!";
        }
    } else {
        $error = "Nama tidak ditemukan!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Pengelolaan Zakat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: url('masjid.png') no-repeat center center fixed;
            background-size: cover;
        }
        .login-container {
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
        .register-box {
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
        <div class="login-container">
            <h2 class="text-center" style="color: goldenrod;">Login - Zakat</h2>
            <?php if (isset($error)) { echo "<div class='alert alert-danger'>$error</div>"; } ?>
            <form action="login.php" method="POST">
                <div class="mb-3">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" name="nama" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-goldenrod w-100">Login</button>
            </form>
            <div class="register-box">
                <p class="mb-0">Belum punya akun?</p>
                <a href="register.php" class="btn btn-goldenrod w-100">Daftar di sini</a>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
