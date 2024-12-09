<?php
session_start();
include 'db.php'; // Termasuk koneksi ke database

// Cek apakah form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data yang dikirim dari form
    $dosen = $_POST['dosen']; // Nama dosen
    $k1 = $_POST['k1'];       // Kualitas Pengajaran
    $k2 = $_POST['k2'];       // Kontribusi Penelitian
    $k3 = $_POST['k3'];       // Kehadiran
    $k4 = $_POST['k4'];       // Penilaian Mahasiswa

    // Validasi input (pastikan semua nilai ada dan angka)
    if (empty($dosen) || empty($k1) || empty($k2) || empty($k3) || empty($k4)) {
        die("Semua kolom harus diisi.");
    }

    // Pastikan nilai kriteria berupa angka
    for ($i = 0; $i < count($dosen); $i++) {
        if (!is_numeric($k1[$i]) || !is_numeric($k2[$i]) || !is_numeric($k3[$i]) || !is_numeric($k4[$i])) {
            die("Semua nilai harus berupa angka.");
        }
    }

    // Data untuk perhitungan
    $data = [];
    for ($i = 0; $i < count($dosen); $i++) {
        $data[] = [$k1[$i], $k2[$i], $k3[$i], $k4[$i]];
    }

    // Bobot untuk setiap kriteria
    $bobot = [0.40, 0.30, 0.20, 0.10]; // Bobot total = 1

    // Fungsi Normalisasi
    function normalisasi($data) {
        $result = [];
        for ($j = 0; $j < count($data[0]); $j++) {
            $max = max(array_column($data, $j)); // Menemukan nilai maksimum per kolom
            foreach ($data as $i => $row) {
                $result[$i][$j] = $row[$j] / $max; // Normalisasi nilai
            }
        }
        return $result;
    }

    // Fungsi untuk menghitung preferensi
    function hitungPreferensi($normalisasi, $bobot) {
        $result = [];
        foreach ($normalisasi as $i => $row) {
            $result[$i] = 0;
            foreach ($row as $j => $value) {
                $result[$i] += $value * $bobot[$j]; // Menghitung nilai preferensi
            }
        }
        return $result;
    }

    // Proses normalisasi dan perhitungan preferensi
    $normalisasi = normalisasi($data);
    $preferensi = hitungPreferensi($normalisasi, $bobot);

    // Mengurutkan preferensi berdasarkan skor tertinggi
    array_multisort($preferensi, SORT_DESC, $dosen); // Mengurutkan dosen dan skor berdasarkan skor preferensi

    // Menyimpan hasil perhitungan ke database
    foreach ($preferensi as $i => $nilai) {
        $nama_dosen = $dosen[$i];
        $skor = $nilai;
        $peringkat = $i + 1; // Peringkat berdasarkan urutan

        // Query untuk menyimpan hasil perhitungan dan peringkat
        $insert_query = "INSERT INTO hasil_saw (nama_dosen, skor, peringkat) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($insert_query);
        $stmt->bind_param("sdi", $nama_dosen, $skor, $peringkat); // Mengikat parameter

        // Menyimpan data
        if (!$stmt->execute()) {
            echo "Terjadi kesalahan saat menyimpan data: " . $stmt->error;
        }
    }

    // Menampilkan hasil perhitungan
    echo "<h2>Proses Perhitungan</h2>";
    echo "<h3>Data yang Dikirimkan:</h3>";
    echo "<table border='1' class='table table-bordered'>";
    echo "<thead><tr><th>Nama Dosen</th><th>Kualitas Pengajaran</th><th>Kontribusi Penelitian</th><th>Kehadiran</th><th>Penilaian Mahasiswa</th></tr></thead><tbody>";

    foreach ($dosen as $index => $nama) {
        echo "<tr>
                <td>" . $nama . "</td>
                <td>" . $k1[$index] . "</td>
                <td>" . $k2[$index] . "</td>
                <td>" . $k3[$index] . "</td>
                <td>" . $k4[$index] . "</td>
            </tr>";
    }

    echo "</tbody></table>";

    // Menampilkan hasil normalisasi
    echo "<h3>Hasil Normalisasi:</h3>";
    echo "<table border='1' class='table table-bordered'>";
    echo "<thead><tr><th>Nama Dosen</th><th>Kualitas Pengajaran</th><th>Kontribusi Penelitian</th><th>Kehadiran</th><th>Penilaian Mahasiswa</th></tr></thead><tbody>";

    foreach ($normalisasi as $index => $row) {
        echo "<tr>
                <td>" . $dosen[$index] . "</td>
                <td>" . number_format($row[0], 3) . "</td>
                <td>" . number_format($row[1], 3) . "</td>
                <td>" . number_format($row[2], 3) . "</td>
                <td>" . number_format($row[3], 3) . "</td>
            </tr>";
    }

    echo "</tbody></table>";

    // Menampilkan hasil perhitungan preferensi
    echo "<h3>Hasil Perhitungan Preferensi:</h3>";
    echo "<table border='1' class='table table-bordered'>";
    echo "<thead><tr><th>Nama Dosen</th><th>Skor</th><th>Peringkat</th></tr></thead><tbody>";

    foreach ($preferensi as $index => $nilai) {
        echo "<tr>
                <td>" . $dosen[$index] . "</td>
                <td>" . number_format($nilai, 3) . "</td>
                <td>" . ($index + 1) . "</td>
            </tr>";
    }

    echo "</tbody></table>";
} else {
    echo "Data tidak valid atau form belum disubmit.";
}

// Menutup koneksi ke database
$conn->close();
?>
