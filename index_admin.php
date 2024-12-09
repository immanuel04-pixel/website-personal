<?php
session_start();

// Cek apakah pengguna sudah login
if (!isset($_SESSION['username'])) {
    header("Location: login.php"); // Jika belum login, arahkan ke halaman login
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - SPK Dosen Terbaik</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #6a11cb, #2575fc);
            font-family: 'Arial', sans-serif;
            color: #fff;
        }

        .container {
            margin-top: 50px;
        }

        .card {
            margin: 20px 0;
            border: none;
            border-radius: 12px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
        }

        .welcome-text {
            font-size: 3.5rem;
            font-weight: bold;
            color: #fff;
            text-align: center;
            text-transform: uppercase;
            letter-spacing: 4px;
            animation: fadeIn 2s ease-out, textGlow 3s infinite alternate;
        }

        .welcome-subtext {
            text-align: center;
            color: #dfe6e9;
            font-size: 1.5rem;
            margin-top: 10px;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes textGlow {
            from {
                text-shadow: 0 0 8px rgba(255, 255, 255, 0.6), 0 0 16px rgba(255, 255, 255, 0.4);
            }
            to {
                text-shadow: 0 0 20px rgba(255, 255, 255, 0.9), 0 0 30px rgba(255, 255, 255, 0.5);
            }
        }

        .btn-custom {
            border-radius: 30px;
            padding: 12px 20px;
            font-size: 1.2rem;
            font-weight: bold;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .btn-custom:hover {
            transform: scale(1.05);
        }

        .btn-primary {
            background: #6a11cb;
            border: none;
        }

        .btn-primary:hover {
            background: #5d0fba;
        }

        .btn-success {
            background: #28a745;
            border: none;
        }

        .btn-success:hover {
            background: #218838;
        }

        .btn-danger {
            background: #dc3545;
            border: none;
        }

        .btn-danger:hover {
            background: #c82333;
        }

        footer {
            margin-top: 50px;
            text-align: center;
            color: #dfe6e9;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-transparent">
        <div class="container">
            <a class="navbar-brand" href="#">Admin Panel</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="index_admin.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="input_data.php">Input Data</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="hasil_perhitungan.php">Hasil Perhitungan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <!-- Menampilkan "Selamat Datang, [username]" -->
                <div class="welcome-text">
                    Selamat Datang, <?= $_SESSION['username']; ?>
                </div>
                <div class="welcome-subtext">
                    Kelola sistem SPK Pemilihan Dosen Terbaik dengan mudah
                </div>
            </div>
        </div>

        <div class="row mt-5">
            <!-- Card Input Data -->
            <div class="col-md-4">
                <div class="card shadow">
                    <div class="card-body text-center">
                        <h5 class="card-title">Input Data</h5>
                        <p class="card-text">Masukkan data dosen dan kriteria penilaian.</p>
                        <a href="input_data.php" class="btn btn-custom btn-primary">Input Data</a>
                    </div>
                </div>
            </div>

            <!-- Card Hasil Perhitungan -->
            <div class="col-md-4">
                <div class="card shadow">
                    <div class="card-body text-center">
                        <h5 class="card-title">Hasil Perhitungan</h5>
                        <p class="card-text">Lihat hasil perhitungan dan peringkat dosen.</p>
                        <a href="hasil_perhitungan.php" class="btn btn-custom btn-success">Lihat Hasil</a>
                    </div>
                </div>
            </div>

            <!-- Card Logout -->
            <div class="col-md-4">
                <div class="card shadow">
                    <div class="card-body text-center">
                        <h5 class="card-title">Logout</h5>
                        <p class="card-text">Keluar dari sistem admin.</p>
                        <a href="logout.php" class="btn btn-custom btn-danger">Logout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        &copy; 2024 Sistem Pendukung Keputusan Pemilihan Dosen Terbaik
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
