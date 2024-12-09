<?php
// Koneksi ke database
include 'db.php';

// Query untuk mengambil semua data hasil perhitungan
$sql = "SELECT * FROM hasil_saw ORDER BY peringkat ASC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Perhitungan - SPK Dosen Terbaik</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #74b9ff, #0984e3);
            font-family: 'Arial', sans-serif;
            color: #fff;
        }
        .container {
            background: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
            color: #333;
        }
        h1 {
            font-weight: bold;
            color: #0984e3;
            font-size: 2.5rem;
            animation: fadeIn 2s ease-in-out, colorChange 3s infinite alternate;
        }
        @keyframes fadeIn {
            0% {
                opacity: 0;
                transform: translateY(-20px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }
        @keyframes colorChange {
            0% {
                color: #0984e3;
            }
            100% {
                color: #74b9ff;
            }
        }
        .table {
            margin-top: 20px;
            border-radius: 8px;
            overflow: hidden;
        }
        .table th {
            background: #0984e3;
            color: #fff;
            text-align: center;
        }
        .table td {
            text-align: center;
        }
        .btn-secondary {
            background: #74b9ff;
            border-color: #0984e3;
        }
        .btn-secondary:hover {
            background: #0984e3;
            border-color: #74b9ff;
        }
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>
    <!-- Container untuk hasil -->
    <div class="container my-5">
        <h1 class="text-center">Hasil Pemilihan Dosen Terbaik</h1>
        <p class="text-center text-muted">Berikut adalah hasil perhitungan yang telah disimpan di database.</p>

        <?php
        // Menampilkan hasil jika ada data
        if ($result->num_rows > 0) {
            echo "<table class='table table-striped table-bordered'>";
            echo "<thead><tr><th>Peringkat</th><th>Nama Dosen</th><th>Skor</th></tr></thead><tbody>";

            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td><span class='badge bg-success'>#" . $row['peringkat'] . "</span></td>
                        <td>" . $row['nama_dosen'] . "</td>
                        <td><strong>" . number_format($row['skor'], 3) . "</strong></td>
                    </tr>";
            }
            echo "</tbody></table>";
        } else {
            echo "<p class='text-danger text-center'>Tidak ada data yang ditemukan.</p>";
        }

        // Menutup koneksi
        $conn->close();
        ?>

        <!-- Tombol Kembali -->
        <div class="d-flex justify-content-center mt-4">
            <a href="index_admin.php" class="btn btn-secondary btn-lg">Kembali ke Input Data</a>
        </div>
    </div>

    <!-- Footer -->
    <div class="footer">
        <p>&copy; 2024 Sistem Pendukung Keputusan Pemilihan Dosen Terbaik</p>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
