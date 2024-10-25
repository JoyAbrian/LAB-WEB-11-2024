<?php
include 'crud.php'; // Mengimpor file untuk koneksi ke database
session_start(); // Memulai sesi untuk menyimpan data pengguna

// Cek apakah pengguna adalah admin
if ($_SESSION['role'] !== 'admin') {
    header('Location: index.php'); // Jika bukan admin, arahkan ke halaman index
    exit; // Menghentikan eksekusi lebih lanjut
}

// Proses untuk menambahkan admin baru
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_admin = $_POST['id_admin']; // Mengambil ID admin dari form
    $username = $_POST['username']; // Mengambil username dari form
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Menghash password

    // Menyiapkan dan mengeksekusi statement untuk menyimpan data admin baru
    $stmt = $conn->prepare('INSERT INTO admin (id_admin, username, password) VALUES (?, ?, ?)');
    $stmt->bind_param('sss', $id_admin, $username, $password); // Mengikat parameter
    $stmt->execute(); // Menjalankan query

    header('Location: index.php'); // Setelah berhasil, arahkan kembali ke index
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet"> <!-- Mengimpor CSS Bootstrap -->
    <title>Tambah Admin</title> <!-- Judul halaman -->
</head>
<body>
    <div class="container mt-5"> <!-- Kontainer untuk tata letak -->
        <h2>Tambah Admin</h2> <!-- Judul form -->
        <form action="tambah.php" method="POST"> <!-- Form untuk menambahkan admin -->
            <div class="form-group"> <!-- Group untuk ID Admin -->
                <label>ID Admin</label>
                <input type="text" name="id_admin" class="form-control" required> <!-- Input untuk ID Admin -->
            </div>
            <div class="form-group"> <!-- Group untuk Username -->
                <label>Username</label>
                <input type="text" name="username" class="form-control" required> <!-- Input untuk Username -->
            </div>
            <div class="form-group"> <!-- Group untuk Password -->
                <label>Password</label>
                <input type="password" name="password" class="form-control" required> <!-- Input untuk Password -->
            </div>
            <button type="submit" class="btn btn-primary">Tambah</button> <!-- Tombol untuk mengirim form -->
        </form>
    </div>
</body>
</html>
