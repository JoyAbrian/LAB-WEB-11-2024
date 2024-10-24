<?php
include 'crud.php'; // Mengimpor file yang berisi fungsi-fungsi CRUD dan koneksi ke database
session_start(); // Memulai sesi untuk mengakses variabel sesi seperti user_id dan role

// Cek apakah user sudah login dan apakah user adalah admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: login.php'); // Jika belum login atau bukan admin, redirect ke halaman login
    exit; // Menghentikan eksekusi kode setelah redirect
}

// Ambil data user yang akan diedit berdasarkan id
if (isset($_GET['id'])) { // Mengecek apakah parameter 'id' ada di URL
    $id = $_GET['id']; // Menyimpan id dari URL ke variabel $id
    $stmt = $conn->prepare('SELECT * FROM users WHERE id = ?'); // Menyiapkan query untuk mengambil data user berdasarkan id
    $stmt->bind_param('i', $id); // Mengikat parameter id sebagai tipe integer
    $stmt->execute(); // Menjalankan query
    $result = $stmt->get_result(); // Mendapatkan hasil query
    $user = $result->fetch_assoc(); // Mengambil data user dalam bentuk array asosiatif
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Mengimpor stylesheet Bootstrap untuk styling form -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <title>Edit User</title> <!-- Judul halaman -->
</head>
<body>
    <div class="container mt-5"> <!-- Membuat container dengan margin atas -->
        <h2>Edit User</h2> <!-- Judul halaman -->
        <form action="proses_edit.php" method="POST" class="mb-3"> <!-- Form untuk mengirim data user yang diedit -->
            <input type="hidden" name="id" value="<?= $user['id'] ?>"> <!-- Input tersembunyi untuk menyimpan ID user -->
            <div class="form-group">
                <label for="username">Username:</label> <!-- Label untuk input username -->
                <input type="text" name="username" class="form-control" value="<?= $user['username'] ?>" required> <!-- Input untuk mengedit username, dengan nilai awal dari database -->
            </div>
            <div class="form-group">
                <label for="nim">NIM:</label> <!-- Label untuk input NIM -->
                <input type="text" name="nim" class="form-control" value="<?= $user['nim'] ?>" required> <!-- Input untuk mengedit NIM, dengan nilai awal dari database -->
            </div>
            <div class="form-group">
                <label for="password">Password (Kosongkan jika tidak ingin diubah):</label> <!-- Label untuk input password -->
                <input type="password" name="password" class="form-control"> <!-- Input password, tidak diisi jika password tidak ingin diubah -->
            </div>
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button> <!-- Tombol untuk menyimpan perubahan -->
        </form>
    </div>
</body>
</html>
