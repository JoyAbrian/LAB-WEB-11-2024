<?php
include 'crud.php'; // Mengimpor file koneksi database
session_start(); // Memulai sesi untuk memastikan user sudah login

// Pastikan hanya admin yang bisa menghapus user
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    // Jika role di session tidak ada atau bukan admin, redirect ke halaman index
    header('Location: index.php');
    exit; // Hentikan eksekusi script agar tidak melanjutkan
}

// Cek apakah ada ID user yang akan dihapus
if (isset($_GET['id'])) {
    $id = $_GET['id']; // Mengambil ID user yang akan dihapus dari URL

    // Pastikan user yang dihapus bukan admin
    $stmt = $conn->prepare('SELECT username FROM users WHERE id = ?');
    $stmt->bind_param('i', $id); // Bind parameter ID ke dalam query
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc(); // Mengambil data user dari hasil query

    if ($user['username'] !== 'admin') {
        // Jika user bukan admin, maka user bisa dihapus
        $deleteStmt = $conn->prepare('DELETE FROM users WHERE id = ?');
        $deleteStmt->bind_param('i', $id); // Bind parameter ID ke dalam query delete
        $deleteStmt->execute(); // Eksekusi query untuk menghapus user
    }

    header('Location: index.php'); // Redirect ke halaman index setelah penghapusan
    exit; // Hentikan eksekusi script setelah redirect
} else {
    // Jika ID tidak ditemukan di URL, redirect ke halaman index
    header('Location: index.php');
}
?>
