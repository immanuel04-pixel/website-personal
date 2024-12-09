<?php
session_start();

// Koneksi ke database
$host = 'localhost';
$username = 'root'; // Ganti dengan username database Anda
$password = ''; // Ganti dengan password database Anda
$dbname = 'rpl'; // Nama database

$conn = new mysqli($host, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username_input = $_POST['username'];
    $password_input = $_POST['password'];

    // Cari pengguna di database
    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username_input);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Verifikasi password
        $row = $result->fetch_assoc();
        if (password_verify($password_input, $row['password'])) {
            // Login berhasil
            $_SESSION['username'] = $username_input;
            header("Location: index_admin.php");
            exit();
        } else {
            $error = "Password salah.";
        }
    } else {
        $error = "Username tidak ditemukan.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SPK Dosen Terbaik</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #74b9ff, #0984e3);
            font-family: 'Arial', sans-serif;
        }

        .login-container {
            max-width: 400px;
            margin: 100px auto;
            background: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        h1 {
            font-size: 2.5rem;
            color: #0984e3;
            font-weight: bold;
            text-align: center;
        }

        .btn-primary {
            background: #0984e3;
            border: none;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background: #065fa5;
        }

        .form-label {
            font-weight: bold;
            color: #333;
        }

        .alert {
            margin-top: 10px;
            font-size: 0.9rem;
            text-align: center;
        }

        .text-center a {
            color: #0984e3;
            text-decoration: none;
        }

        .text-center a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h1>Login </h1>

        <?php if (!empty($error)): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>

        <form action="login.php" method="POST">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan username Anda" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password Anda" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Login</button>
        </form>
        <div class="text-center mt-3">
            <a href="registrasi.php">Belum punya akun? Registrasi di sini</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
