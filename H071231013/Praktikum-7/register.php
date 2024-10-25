<?php
include 'crud.php'; // Koneksi ke database
session_start(); // Memulai sesi untuk menyimpan data pengguna

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Mengambil input dari form
    $username = $_POST['username'];
    $password_plain = $_POST['password']; // Simpan password plain untuk validasi admin
    $nim = $_POST['nim']; // Ambil nilai NIM dari form
    $prodi = $_POST['prodi']; // Ambil nilai Program Studi dari form

    // Cek apakah username dan password adalah 'admin'
    if ($username === 'admin' && $password_plain === 'admin') {
        $role = 'admin';  // Beri role 'admin' untuk user 'admin' dengan password 'admin'
        $password = password_hash($password_plain, PASSWORD_BCRYPT); // Hash password admin
    } else {
        $role = 'user';  // Semua user lainnya mendapatkan role 'user'
        $password = password_hash($password_plain, PASSWORD_BCRYPT); // Hash password
    }

    // Pastikan username atau NIM belum ada di database
    $checkStmt = $conn->prepare('SELECT * FROM users WHERE username = ? OR nim = ?');
    $checkStmt->bind_param('ss', $username, $nim);
    $checkStmt->execute();
    $checkResult = $checkStmt->get_result();

    if ($checkResult->num_rows > 0) {
        // Jika username atau NIM sudah digunakan
        $error = "Username atau NIM sudah digunakan!";
    } else {
        // Masukkan NIM, Program Studi, username, password, dan role ke dalam database
        $stmt = $conn->prepare('INSERT INTO users (username, password, nim, prodi, role) VALUES (?, ?, ?, ?, ?)');
        $stmt->bind_param('sssss', $username, $password, $nim, $prodi, $role);

        if ($stmt->execute()) {
            // Jika berhasil, redirect ke halaman login
            header('Location: login.php');
            exit;
        } else {
            // Jika terjadi kesalahan
            $error = "Terjadi kesalahan saat registrasi!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* CSS untuk mengubah warna background secara dinamis */
        body {
            animation: color-change 10s infinite alternate; /* Warna background berubah secara berkala */
        }

        @keyframes color-change {
            0% {
                background-color: #4caf50; /* Warna hijau pada awalnya */
            }
            100% {
                background-color: #ffeb3b; /* Warna kuning setelah beberapa detik */
            }
        }

        /* Mengatur gambar sebagai latar belakang untuk menutupi seluruh area */
        .register-container {
            background-image: url('wallpaperflare.com_wallpaper (2).jpg'); /* Gambar latar belakang */
            background-size: cover; /* Ukuran gambar menyesuaikan */
            background-position: center;
            background-repeat: no-repeat;
            padding: 40px 20px; /* Padding untuk memberikan jarak antar elemen */
            border-radius: 10px; /* Membuat sudut membulat */
        }

        /* Overlay tetap untuk efek gelap di atas gambar */
        .overlay {
            background-color: rgba(0, 0, 0, 0.6); /* Warna overlay hitam transparan */
        }

        /* Animasi untuk teks yang berganti warna */
        @keyframes text-change {
            0% {
                color: #fbbf24; /* Warna kuning */
            }
            50% {
                color: #3b82f6; /* Warna biru */
            }
            100% {
                color: #f43f5e; /* Warna merah */
            }
        }

        .dynamic-text {
            animation: text-change 5s infinite alternate; /* Teks berganti warna setiap 5 detik */
            font-weight: bold; /* Membuat teks tebal */
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5); /* Bayangan pada teks */
            text-align: center; /* Teks berada di tengah */
        }

        .decoration {
            position: relative;
            display: block;
            font-size: 1.5rem;
            margin-bottom: 10px;
            color: #fff;
        }

        .welcome-text {
            font-size: 2rem;
            margin-bottom: 20px; /* Jarak di antara teks */
        }

        .join-text {
            font-size: 1.5rem;
        }

    </style>
</head>
<body class="flex items-center justify-center min-h-screen">
    <div class="overlay absolute inset-0 bg-black opacity-60"></div> <!-- Overlay gelap -->
    <div class="register-container relative bg-opacity-40 rounded-lg shadow-lg text-center text-orange-400 z-10">
        <h2 class="decoration dynamic-text welcome-text">✨ WELCOME ✨</h2> <!-- Teks WELCOME di tengah -->
        <h2 class="decoration dynamic-text join-text">🚀 Ayo Melakukan Register dan Masuk! 🚀</h2> <!-- Teks JOIN di bawah WELCOME -->

        <?php if (isset($error)) { echo "<div class='bg-red-500 text-white p-3 rounded-lg mb-4'>$error</div>"; } ?> <!-- Tampilkan error jika ada -->
        <form action="register.php" method="POST">
            <input type="text" name="username" placeholder="Username" required class="w-full p-3 mb-4 rounded-lg bg-green-500 bg-opacity-50 text-blue-700 placeholder-blue-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-opacity-100 dynamic-text">
            <input type="password" name="password" placeholder="Password" required class="w-full p-3 mb-4 rounded-lg bg-green-500 bg-opacity-50 text-blue-700 placeholder-blue-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-opacity-100 dynamic-text">
            <input type="text" name="nim" placeholder="NIM" required class="w-full p-3 mb-4 rounded-lg bg-green-500 bg-opacity-50 text-blue-700 placeholder-blue-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-opacity-100 dynamic-text">
            <input type="text" name="prodi" placeholder="Program Studi" required class="w-full p-3 mb-4 rounded-lg bg-green-500 bg-opacity-50 text-blue-700 placeholder-blue-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-opacity-100 dynamic-text">
            <button type="submit" class="w-full p-3 bg-purple-600 hover:bg-purple-700 text-white font-bold rounded-lg transition duration-300 dynamic-text">Register</button>
        </form>
    </div>
</body>
</html>
