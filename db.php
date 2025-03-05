<?php
// db.php - Koneksi ke database

// Konfigurasi database
$host = 'localhost'; // Nama host (biasanya localhost)
$user = 'root'; // Nama pengguna MySQL
$pass = ''; // Kata sandi MySQL (kosong jika default)
$dbname = 'zakat_db'; // Nama database yang digunakan

// Membuat koneksi ke database
$conn = new mysqli($host, $user, $pass, $dbname);

// Cek apakah koneksi berhasil
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error); // Menampilkan pesan jika koneksi gagal
} 
?>
