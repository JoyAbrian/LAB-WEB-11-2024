<?php
include 'crud.php'; // Mengimpor file koneksi database
session_start(); // Memulai sesi untuk mengecek status login

// Pastikan hanya admin yang bisa menambah user
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    // Jika user bukan admin, arahkan ke halaman index
    header('Location: index.php');
    exit; // Menghentikan eksekusi script
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Mengambil data dari form
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Mengenkripsi password
    $nim = $_POST['nim'];
    $prodi = $_POST['prodi']; // Ambil data prodi dari form
    $role = 'user'; // Semua user baru akan diberikan role 'user'

    // Cek apakah username atau nim sudah ada di database
    $checkStmt = $conn->prepare('SELECT * FROM users WHERE username = ? OR nim = ?');
    $checkStmt->bind_param('ss', $username, $nim); // Bind parameter username dan nim
    $checkStmt->execute();
    $checkResult = $checkStmt->get_result();

    if ($checkResult->num_rows > 0) {
        // Jika username atau nim sudah ada
        $error = "Username atau NIM sudah digunakan!";
    } else {
        // Insert user baru ke database, termasuk program studi (prodi)
        $stmt = $conn->prepare('INSERT INTO users (username, password, nim, prodi, role) VALUES (?, ?, ?, ?, ?)');
        $stmt->bind_param('sssss', $username, $password, $nim, $prodi, $role); // Tambahkan prodi di sini

        if ($stmt->execute()) {
            // Jika berhasil menambahkan user, redirect ke halaman index
            header('Location: index.php');
            exit;
        } else {
            // Jika gagal menambahkan user
            $error = "Gagal menambahkan user!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah User</title>
    <link rel="stylesheet" href="style.css"> <!-- Link ke file CSS eksternal -->
</head>
<body>
    <div class="container">
        <h2>Tambah User Baru</h2>

        <?php if (isset($error)): ?>
            <!-- Menampilkan pesan error jika ada -->
            <div class="error"><?= $error ?></div>
        <?php endif; ?>

        <form action="tambah_user.php" method="POST">
            <!-- Input untuk username -->
            <label for="username">Username:</label>
            <input type="text" name="username" required>

            <!-- Input untuk password -->
            <label for="password">Password:</label>
            <input type="password" name="password" required>

            <!-- Input untuk NIM -->
            <label for="nim">NIM:</label>
            <input type="text" name="nim" required>

            <!-- Input untuk program studi (prodi) -->
            <label for="prodi">Program Studi:</label>
            <input type="text" name="prodi" required> <!-- Tambahkan input prodi -->

            <!-- Tombol untuk submit form -->
            <button type="submit">Tambah User</button>
        </form>
    </div>
</body>
</html>
