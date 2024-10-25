<?php
include 'crud.php'; // Mengimpor file yang berisi koneksi database dan fungsi CRUD
session_start(); // Memulai sesi untuk menggunakan variabel sesi seperti user_id dan role

// Cek apakah user sudah login
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php'); // Jika belum login, redirect ke halaman login
    exit; // Hentikan eksekusi skrip setelah redirect
}

// Cek apakah pengguna adalah admin
$isAdmin = isset($_SESSION['role']) && $_SESSION['role'] === 'admin'; // Menyimpan status apakah user adalah admin

// Menampilkan semua data users, termasuk id, username, role, nim, dan prodi
$result = $conn->query('SELECT id, username, role, nim, prodi FROM users'); // Query untuk mengambil semua data user
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Admin dan User</title>
    <!-- Mengimpor Tailwind CSS untuk styling yang responsif -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Mengatur perubahan warna background antara biru dan merah */
        body {
            animation: bg-color-change 10s infinite alternate; /* Warna background akan berganti tiap 10 detik */
        }

        @keyframes bg-color-change {
            0% {
                background-color: #1e3a8a; /* Warna biru */
            }
            100% {
                background-color: #dc2626; /* Warna merah */
            }
        }

        /* Mengubah latar belakang tabel dan box data */
        .dynamic-bg {
            animation: bg-color-change-section 10s infinite alternate; /* Animasi pergantian warna untuk tabel */
        }

        @keyframes bg-color-change-section {
            0% {
                background-color: #3b82f6; /* Warna biru */
            }
            100% {
                background-color: #f87171; /* Warna merah */
            }
        }

        /* Mengatur warna latar belakang dan teks untuk tabel dan form */
        .bg-light-green {
            background-color: #d1fae5; /* Warna hijau terang */
        }
        .text-dark-green {
            color: #064e3b; /* Warna hijau gelap */
        }

        /* Menambahkan gambar latar belakang */
        .background-image {
            background-image: url('wallpaperflare.com_wallpaper (1).jpg'); /* Pastikan nama file sesuai */
            background-size: cover; /* Gambar memenuhi kontainer */
            background-position: center; /* Gambar berada di tengah kontainer */
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center"> <!-- Mengatur agar konten ditampilkan di tengah layar -->
    <div class="container mx-auto p-8 bg-light-green shadow-lg rounded-lg dynamic-bg background-image relative"> <!-- Box utama dengan gaya dinamis -->
        <h2 class="text-3xl font-bold text-blue-500 mb-6 text-center">Data Admin dan User</h2> <!-- Judul halaman -->

        <!-- Form Pencarian Data Mahasiswa -->
        <div class="mb-6">
            <form action="search.php" method="GET" class="flex items-center"> <!-- Form pencarian data mahasiswa -->
                <input type="text" name="search" placeholder="Cari mahasiswa..." class="w-full px-4 py-2 border border-blue-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none text-blue-500 placeholder-blue-300" required> <!-- Input pencarian -->
                <button type="submit" class="ml-2 bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-lg transition duration-300">Cari</button> <!-- Tombol submit pencarian -->
            </form>
        </div>

        <!-- Tombol Logout di pojok kanan atas -->
        <div class="absolute top-4 right-4"> <!-- Posisi tombol logout di pojok kanan atas -->
            <a href="logout.php" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg font-bold shadow-lg transition duration-300">Logout</a> <!-- Tombol Logout -->
        </div>

        <!-- Menampilkan informasi selamat datang dengan role user -->
        <div class="bg-red-100 text-red-700 p-4 rounded-lg mb-6">
            <strong class="text-blue-500">Selamat datang, <?= $_SESSION['username']; ?>!</strong><br> <!-- Menampilkan username dari sesi -->
            Role: <span class="text-red-500"><?= $_SESSION['role']; ?></span> <!-- Menampilkan role user dari sesi -->
        </div>

        <!-- Jika user adalah admin, tampilkan form tambah user -->
        <?php if ($isAdmin) : ?>
        <form action="proses_input.php" method="POST" class="mb-6 space-y-4"> <!-- Form untuk menambah user baru -->
            <div class="form-group">
                <label for="username" class="text-red-500">Username:</label> <!-- Input username -->
                <input type="text" name="username" class="w-full px-4 py-2 border border-blue-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none text-blue-500 placeholder-blue-300" required>
            </div>
            <div class="form-group">
                <label for="password" class="text-red-500">Password:</label> <!-- Input password -->
                <input type="password" name="password" class="w-full px-4 py-2 border border-blue-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none text-blue-500 placeholder-blue-300" required>
            </div>
            <div class="form-group">
                <label for="nim" class="text-red-500">NIM:</label> <!-- Input NIM -->
                <input type="text" name="nim" class="w-full px-4 py-2 border border-blue-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none text-blue-500 placeholder-blue-300" required>
            </div>
            <div class="form-group">
                <label for="prodi" class="text-red-500">Prodi:</label> <!-- Input Prodi -->
                <input type="text" name="prodi" class="w-full px-4 py-2 border border-blue-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none text-blue-500 placeholder-blue-300" required>
            </div>
            <button type="submit" name="tambah" class="w-full bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 rounded-lg transition duration-300">Tambah User</button> <!-- Tombol tambah user -->
        </form>
        <?php endif; ?>

        <!-- Tabel data user -->
        <div class="overflow-x-auto"> <!-- Tabel user dengan scroll horizontal -->
            <table class="min-w-full table-auto border-collapse border border-blue-300 dynamic-bg"> <!-- Tabel dengan gaya dinamis -->
                <thead class="bg-blue-500 text-white"> <!-- Bagian header tabel -->
                    <tr>
                        <th class="border px-4 py-2">No</th> <!-- Kolom nomor -->
                        <th class="border px-4 py-2">Username</th>
                        <th class="border px-4 py-2">NIM</th>
                        <th class="border px-4 py-2">Prodi</th>
                        <th class="border px-4 py-2">Role</th> 
                        <th class="border px-4 py-2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; while ($row = $result->fetch_assoc()) : ?> <!-- Looping untuk menampilkan data user -->
                    <tr class="bg-light-green hover:bg-red-100"> <!-- Baris data dengan efek hover -->
                        <td class="border px-4 py-2 text-blue-500"><?= $i++ ?></td> <!-- Menampilkan nomor urut -->
                        <td class="border px-4 py-2 text-red-500"><?= $row['username'] ?></td> <!-- Menampilkan username -->
                        <td class="border px-4 py-2 text-blue-500"><?= $row['nim'] ?></td> <!-- Menampilkan NIM -->
                        <td class="border px-4 py-2 text-blue-500"><?= $row['prodi'] ?></td> <!-- Menampilkan Prodi -->
                        <td class="border px-4 py-2 text-red-500"><?= $row['role'] ?></td> <!-- Menampilkan role -->
                        <td class="border px-4 py-2">
                            <!-- Tampilkan opsi edit dan hapus jika user adalah admin dan bukan user admin -->
                            <?php if ($isAdmin && $row['username'] !== 'admin') : ?>
                            <a href="edit.php?id=<?= $row['id'] ?>" class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded-md">Edit</a> <!-- Link untuk mengedit user -->
                            <a href="proses_hapus.php?id=<?= $row['id'] ?>" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-md" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a> <!-- Link untuk menghapus user -->
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
