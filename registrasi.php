<?php
// Koneksi ke database
$host = 'localhost'; // Host database
$username = 'root';  // Username database
$password = '';      // Password database
$dbname = 'rpl';     // Nama database

$conn = new mysqli($host, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari form
    $username_input = $_POST['username'];
    $password_input = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];

    // Validasi form
    if (empty($username_input) || empty($password_input) || empty($password_confirm)) {
        $error = "Semua kolom harus diisi.";
    } elseif ($password_input !== $password_confirm) {
        $error = "Password dan konfirmasi password tidak cocok.";
    } else {
        // Cek apakah username sudah ada
        $sql = "SELECT * FROM users WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username_input);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $error = "Username sudah terdaftar.";
        } else {
            // Hash password sebelum menyimpannya
            $password_hashed = password_hash($password_input, PASSWORD_DEFAULT);

            // Menyimpan data akun baru ke database
            $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss", $username_input, $password_hashed);
            $stmt->execute();

            // Redirect ke halaman login setelah berhasil
            header("Location: login.php");
            exit();
        }
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi - SPK Dosen Terbaik</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;600&display=swap');
        
        body {
            background: linear-gradient(to right, #6a11cb, #2575fc);
            font-family: 'Montserrat', sans-serif;
            color: #fff;
        }

        .container {
            background: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            margin: 50px auto;
            transform: scale(1);
            animation: fadeIn 1s ease-out;
        }

        h1 {
            color: #007bff;
            font-size: 2.5rem;
            font-weight: 600;
            text-align: center;
            margin-bottom: 20px;
        }

        .form-label {
            font-weight: 600;
            color: #333;
        }

        .form-control {
            border-radius: 6px;
            padding: 12px 20px;
            font-size: 1rem;
            margin-bottom: 15px;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            font-size: 1.2rem;
            padding: 12px 20px;
            border-radius: 30px;
            width: 100%;
            font-weight: bold;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }

        .alert {
            margin-top: 15px;
            border-radius: 5px;
            padding: 15px;
            font-size: 1rem;
        }

        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 0.9rem;
            color: #6c757d;
        }

        .footer a {
            color: #007bff;
            text-decoration: none;
        }

        .footer a:hover {
            text-decoration: underline;
        }

        /* Animation for the container */
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

        /* Responsive Design */
        @media (max-width: 576px) {
            .container {
                padding: 20px;
            }

            h1 {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>
    <div class="container my-5">
        <h1>Registrasi Akun</h1>

        <?php if (!empty($error)): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>

        <form action="registrasi.php" method="POST">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="mb-3">
                <label for="password_confirm" class="form-label">Konfirmasi Password</label>
                <input type="password" class="form-control" id="password_confirm" name="password_confirm" required>
            </div>
            <button type="submit" class="btn btn-primary">Registrasi</button>
        </form>
        <div class="text-center mt-3">
            <a href="login.php">Sudah punya akun? Login di sini</a>
        </div>
    </div>

    <div class="footer">
        &copy; 2024 Sistem Pendukung Keputusan Pemilihan Dosen Terbaik
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
