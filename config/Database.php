<?php 
// Informasi koneksi ke database
$servername = "localhost"; // Nama server database (biasanya localhost)
$username = "root"; // Nama pengguna database
$password = ""; // Kata sandi database
$database = "cv_aquila_indonesia"; // Nama database yang ingin Anda hubungkan

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $database);

// Memeriksa koneksi
if ($conn->connect_error) {
  die("Koneksi gagal: " . $conn->connect_error);
}