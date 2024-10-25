<?php
include 'crud.php'; // Mengimpor file koneksi database
session_start(); // Memulai sesi untuk memastikan user sudah login

// Pastikan hanya admin yang bisa mengedit user
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    // Jika role di session tidak ada atau bukan admin, redirect ke halaman index
    header('Location: index.php');
    exit; // Hentikan eksekusi script untuk menghindari akses lebih lanjut
}

// Proses pengeditan user, hanya berjalan jika metode permintaan adalah POST dan ID user disediakan
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = $_POST['id']; // Mengambil ID user yang akan diedit dari form
    $username = $_POST['username']; // Mengambil username yang diedit dari form
    $nim = $_POST['nim']; // Mengambil NIM yang diedit dari form

    // Query untuk mengupdate user berdasarkan ID
    $stmt = $conn->prepare('UPDATE users SET username = ?, nim = ? WHERE id = ?');
    $stmt->bind_param('ssi', $username, $nim, $id); // Bind parameter username, nim, dan id ke dalam query

    if ($stmt->execute()) {
        // Jika eksekusi berhasil, redirect ke halaman index
        header('Location: index.php');
        exit; // Hentikan eksekusi script setelah redirect
    } else {
        $error = "Gagal mengedit user!"; // Jika terjadi kesalahan, tampilkan pesan error
    }
} else {
    // Jika metode bukan POST atau ID tidak ada, redirect ke halaman index
    header('Location: index.php');
}
?>
