<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SPK Dosen Terbaik - Input Data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap');
        
        body {
            background: linear-gradient(to right, #74b9ff, #0984e3);
            font-family: 'Poppins', sans-serif;
            color: #fff;
        }
        
        .navbar {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .navbar-nav .nav-link {
            font-weight: bold;
            transition: color 0.3s ease;
        }

        .navbar-nav .nav-link:hover {
            color: #f1c40f; /* Warna hover */
        }

        /* Warna merah untuk teks Home */
        .navbar-nav .nav-link[href="index_admin.php"] {
            color: #e74c3c !important; /* Warna merah */
        }
        
        .header {
            background: #0984e3;
            color: white;
            padding: 20px 0;
            border-radius: 0 0 20px 20px;
            text-shadow: 1px 1px 5px rgba(0, 0, 0, 0.5);
            animation: fadeIn 2s ease-in-out;
        }
        
        .header h1 {
            font-size: 3rem;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 3px;
        }
        
        .header p {
            font-size: 1.2rem;
            font-weight: 500;
            margin-top: 5px;
        }
        
        .container {
            margin-top: 20px;
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            color: #333;
        }
        
        .form-label {
            font-weight: bold;
            font-size: 1.1rem;
            color: #0984e3;
        }
        
        .btn-secondary, .btn-primary {
            border-radius: 30px;
            padding: 10px 20px;
            font-size: 1rem;
            font-weight: bold;
            transition: all 0.3s ease;
        }
        
        .btn-secondary:hover {
            background-color: #6c757d;
            transform: scale(1.05);
        }
        
        .btn-primary:hover {
            background-color: #065fa5;
            transform: scale(1.05);
        }
        
        .footer {
            margin-top: 20px;
            text-align: center;
            color: #fff;
            font-size: 0.9rem;
        }
        
        /* Animasi untuk header */
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
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="#">SPK Dosen Terbaik</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index_admin.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="hasil_perhitungan.php">hasil perhitungan</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Header -->
    <div class="header text-center">
        <h1>Input Data Dosen</h1>
        <p>Masukkan data dosen beserta nilai kriteria</p>
    </div>

    <!-- Form Input -->
    <div class="container my-5">
        <form action="proses.php" method="POST" id="data-form">
            <div class="row g-3 align-items-center">
                <div class="col-md-4">
                    <label for="dosen" class="form-label">Nama Dosen</label>
                    <input type="text" name="dosen[]" class="form-control" placeholder="Masukkan nama dosen" required>
                </div>
                <div class="col-md-2">
                    <label for="k1" class="form-label">Kualitas Pengajaran</label>
                    <input type="number" step="0.01" name="k1[]" class="form-control" placeholder="Nilai (0-10)" min="0" max="10" required>
                </div>
                <div class="col-md-2">
                    <label for="k2" class="form-label">Kontribusi Penelitian</label>
                    <input type="number" step="0.01" name="k2[]" class="form-control" placeholder="Nilai (0-10)" min="0" max="10" required>
                </div>
                <div class="col-md-2">
                    <label for="k3" class="form-label">Kehadiran</label>
                    <input type="number" step="0.01" name="k3[]" class="form-control" placeholder="Nilai (0-10)" min="0" max="10" required>
                </div>
                <div class="col-md-2">
                    <label for="k4" class="form-label">Penilaian Mahasiswa</label>
                    <input type="number" step="0.01" name="k4[]" class="form-control" placeholder="Nilai (0-10)" min="0" max="10" required>
                </div>
            </div>
            <div id="additional-rows"></div>
            <div class="d-flex justify-content-between my-3">
                <button type="button" class="btn btn-secondary add-row">Tambah Dosen</button>
                <button type="submit" class="btn btn-primary">Hitung Hasil</button>
            </div>
        </form>
    </div>

    <div class="footer">
        &copy; 2024 Sistem Pendukung Keputusan Pemilihan Dosen Terbaik
    </div>

    <script>
        // Script untuk menambahkan baris input dosen
        document.querySelector('.add-row').addEventListener('click', function () {
            const row = `
            <div class="row g-3 align-items-center mt-2">
                <div class="col-md-4">
                    <label for="dosen" class="form-label">Nama Dosen</label>
                    <input type="text" name="dosen[]" class="form-control" placeholder="Masukkan nama dosen" required>
                </div>
                <div class="col-md-2">
                    <label for="k1" class="form-label">Kualitas Pengajaran</label>
                    <input type="number" step="0.01" name="k1[]" class="form-control" placeholder="Nilai (0.01-10)" min="0.01" max="10" required>
                </div>
                <div class="col-md-2">
                    <label for="k2" class="form-label">Kontribusi Penelitian</label>
                    <input type="number" step="0.01" name="k2[]" class="form-control" placeholder="Nilai (0.01-10)" min="0.01" max="10" required>
                </div>
                <div class="col-md-2">
                    <label for="k3" class="form-label">Kehadiran</label>
                    <input type="number" step="0.01" name="k3[]" class="form-control" placeholder="Nilai (0.01-10)" min="0.01" max="10" required>
                </div>
                <div class="col-md-2">
                    <label for="k4" class="form-label">Penilaian Mahasiswa</label>
                    <input type="number" step="0.01" name="k4[]" class="form-control" placeholder="Nilai (0.01-10)" min="0.01" max="10" required>
                </div>
            </div>`;
            document.getElementById('additional-rows').insertAdjacentHTML('beforeend', row);
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
