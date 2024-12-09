<?php
$host = 'localhost';   // Host database
$username = 'root';    // Username database (sesuaikan dengan setting Anda)
$password = '';        // Password database (kosong jika default pada XAMPP/WAMP)
$dbname = 'rpl';       // Nama database

// Koneksi ke database
$conn = new mysqli($host, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
