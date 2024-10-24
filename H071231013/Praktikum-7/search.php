<?php
include 'crud.php'; // Mengimpor file untuk koneksi ke database
session_start(); // Memulai sesi untuk menyimpan data pengguna

// Cek apakah user sudah login
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php'); // Jika belum login, arahkan ke halaman login
    exit; // Menghentikan eksekusi lebih lanjut
}

// Cek apakah pengguna adalah admin
$isAdmin = isset($_SESSION['role']) && $_SESSION['role'] === 'admin'; // Memeriksa apakah role adalah 'admin'

// Ambil nilai pencarian dari input
$searchTerm = isset($_GET['search']) ? $_GET['search'] : ''; // Mengambil nilai pencarian dari parameter GET

// Siapkan query untuk mencari data mahasiswa
if ($searchTerm) {
    // Menghindari SQL Injection dengan mengamankan input
    $searchTerm = $conn->real_escape_string($searchTerm);
    // Mengambil data mahasiswa berdasarkan username atau NIM yang mengandung nilai pencarian
    $result = $conn->query("SELECT id, username, role, nim FROM users WHERE username LIKE '%$searchTerm%' OR nim LIKE '%$searchTerm%'");
} else {
    // Jika tidak ada pencarian, ambil semua data mahasiswa
    $result = $conn->query('SELECT id, username, role, nim FROM users');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mahasiswa</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Tambahkan CSS sesuai kebutuhan */
    </style>
</head>
<body class="min-h-screen flex items-center justify-center">
    <div class="container mx-auto p-8 bg-light-green shadow-lg rounded-lg">
        <h2 class="text-3xl font-bold text-blue-500 mb-6 text-center">Hasil Pencarian Mahasiswa</h2> <!-- Judul halaman -->

        <div class="bg-red-100 text-red-700 p-4 rounded-lg mb-6">
            <strong class="text-blue-500">Selamat datang, <?= $_SESSION['username']; ?>!</strong><br>
            Role: <span class="text-red-500"><?= $_SESSION['role']; ?></span> <!-- Menampilkan username dan role pengguna -->
        </div>

        <!-- Tabel data user -->
        <div class="overflow-x-auto">
            <table class="min-w-full table-auto border-collapse border border-blue-300">
                <thead class="bg-blue-500 text-white">
                    <tr>
                        <th class="border px-4 py-2">No</th> <!-- Kolom nomor -->
                        <th class="border px-4 py-2">Username</th> <!-- Kolom username -->
                        <th class="border px-4 py-2">NIM</th> <!-- Kolom NIM -->
                        <th class="border px-4 py-2">Role</th> <!-- Kolom role -->
                        <th class="border px-4 py-2">Action</th> <!-- Kolom aksi -->
                    </tr>
                </thead>
                <tbody>
                    <?php if ($result->num_rows > 0) : ?> <!-- Memeriksa apakah ada data yang ditemukan -->
                        <?php $i = 1; while ($row = $result->fetch_assoc()) : ?> <!-- Mengambil setiap baris data -->
                        <tr class="bg-light-green hover:bg-red-100"> <!-- Baris dengan efek hover -->
                            <td class="border px-4 py-2 text-blue-500"><?= $i++ ?></td> <!-- Nomor urut -->
                            <td class="border px-4 py-2 text-red-500"><?= $row['username'] ?></td> <!-- Username -->
                            <td class="border px-4 py-2 text-blue-500"><?= $row['nim'] ?></td> <!-- NIM -->
                            <td class="border px-4 py-2 text-red-500"><?= $row['role'] ?></td> <!-- Role -->
                            <td class="border px-4 py-2"> <!-- Kolom aksi -->
                                <?php if ($isAdmin && $row['username'] !== 'admin') : ?> <!-- Hanya admin yang dapat mengedit atau menghapus -->
                                <a href="edit.php?id=<?= $row['id'] ?>" class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded-md">Edit</a>
                                <a href="proses_hapus.php?id=<?= $row['id'] ?>" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-md" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a> <!-- Konfirmasi sebelum menghapus -->
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    <?php else: ?> <!-- Jika tidak ada hasil ditemukan -->
                        <tr>
                            <td colspan="5" class="text-center border px-4 py-2">Tidak ada hasil ditemukan untuk "<?= htmlspecialchars($searchTerm) ?>"</td> <!-- Pesan jika tidak ada data -->
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
