<?php
// Koneksi ke database
$host = 'localhost';
$username = 'root';
$password = ''; // Ganti dengan password database Anda
$dbname = 'rpl';

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Data akun admin
$username_admin = "admin";
$password_admin = "admin123"; // Ganti dengan password yang diinginkan

// Hash password
$password_hashed = password_hash($password_admin, PASSWORD_DEFAULT);

// Menyimpan data admin ke database
$sql = "INSERT INTO users (username, password) VALUES (?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $username_admin, $password_hashed);
$stmt->execute();

echo "Akun admin berhasil dibuat.";

$conn->close();
?>
