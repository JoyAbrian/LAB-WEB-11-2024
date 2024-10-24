<?php
include 'crud.php'; // Mengimpor file koneksi ke database
session_start(); // Memulai sesi untuk menyimpan data login user

// Cek apakah admin sudah ada dalam database, jika tidak tambahkan
$stmt = $conn->prepare('SELECT * FROM users WHERE username = ?'); // Siapkan query untuk mencari user dengan username admin
$admin_username = "admin"; // Set username admin
$stmt->bind_param('s', $admin_username); // Bind parameter username
$stmt->execute(); // Jalankan query
$result = $stmt->get_result(); // Dapatkan hasil query
$admin = $result->fetch_assoc(); // Ambil data admin

if (!$admin) {
    // Jika admin tidak ditemukan di database, tambahkan admin default dengan username: admin, password: admin
    $default_username = 'admin'; // Username default admin
    $default_password = password_hash('admin', PASSWORD_BCRYPT); // Password default admin dienkripsi menggunakan bcrypt
    $default_role = 'admin'; // Role untuk admin

    // Siapkan query untuk memasukkan data admin ke database
    $stmt = $conn->prepare('INSERT INTO users (username, password, role) VALUES (?, ?, ?)');
    $stmt->bind_param('sss', $default_username, $default_password, $default_role); // Bind parameter untuk query
    $stmt->execute(); // Jalankan query
}

// Proses login
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data username dan password dari form login
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (empty($username) || empty($password)) {
        $error = 'Username dan password harus diisi!'; // Validasi jika input kosong
    } else {
        // Mencari user berdasarkan username di database
        $stmt = $conn->prepare('SELECT * FROM users WHERE username = ?');
        $stmt->bind_param('?', $username); // Bind parameter username
        $stmt->execute(); // Jalankan query
        $result = $stmt->get_result(); // Dapatkan hasil query
        $user = $result->fetch_assoc(); // Ambil data user

        if ($user) {
            // Memverifikasi password user dengan hash password yang tersimpan di database
            if (password_verify($password, $user['password'])) {
                // Jika password valid, simpan informasi user di session
                $_SESSION['user_id'] = $user['id']; // Simpan ID user di session
                $_SESSION['username'] = $user['username']; // Simpan username di session
                $_SESSION['nim'] = $user['nim']; // Simpan NIM di session

                // Cek apakah user adalah admin atau user biasa
                if ($user['username'] === 'admin') {
                    $_SESSION['role'] = 'admin'; // Jika username adalah 'admin', set role sebagai admin
                } else {
                    $_SESSION['role'] = 'user'; // Jika user lain, set role sebagai user
                }

                // Redirect ke halaman index setelah login berhasil
                header('Location: index.php');
                exit; // Hentikan eksekusi skrip setelah redirect
            } else {
                $error = 'Password salah!'; // Jika password tidak valid
            }
        } else {
            $error = 'Username tidak ditemukan!'; // Jika username tidak ditemukan di database
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page - SMAN 5 Sinjai</title>
    <script src="https://cdn.tailwindcss.com"></script> <!-- Mengimpor Tailwind CSS untuk styling -->
    <style>
        /* Animasi untuk mengubah warna background secara dinamis */
        body {
            animation: color-change 10s infinite alternate; /* Background akan berubah warna setiap 10 detik */
        }

        @keyframes color-change {
            0% {
                background-color: #1e3a8a; /* Warna biru */
            }
            100% {
                background-color: #ef4444; /* Warna merah */
            }
        }

        /* Animasi warna teks */
        @keyframes text-color-change {
            0% {
                color: #6b46c1; /* Warna ungu */
            }
            25% {
                color: #d53f8c; /* Warna merah muda */
            }
            50% {
                color: #48bb78; /* Warna hijau */
            }
            75% {
                color: #38b2ac; /* Warna turquoise */
            }
            100% {
                color: #6b46c1; /* Kembali ke warna ungu */
            }
        }

        /* Kelas untuk teks dengan animasi perubahan warna */
        .animated-text {
            animation: text-color-change 5s infinite; /* Teks akan berganti warna setiap 5 detik */
        }

        /* Styling untuk input dengan border ungu */
        .input-border {
            border-color: #4f46e5; /* Border berwarna ungu */
        }
        
        .input-focus:focus {
            border-color: #4f46e5; /* Border berwarna ungu saat fokus */
            outline: none; /* Menghilangkan outline bawaan */
        }

        /* Styling untuk tombol dengan efek hover */
        .button-hover {
            background-color: #6b46c1; /* Warna latar tombol ungu */
            color: white; /* Warna teks putih */
            padding: 10px; /* Padding tombol */
            border: none; /* Menghilangkan border */
            border-radius: 5px; /* Membuat sudut tombol bulat */
            transition: background-color 0.3s ease, transform 0.2s; /* Transisi pada hover */
        }

        .button-hover:hover {
            background-color: #4f46e5; /* Warna tombol saat hover */
            transform: scale(1.05); /* Efek zoom pada hover */
        }

        /* Styling untuk link register */
        .register-link {
            text-decoration: underline; /* Memberikan garis bawah pada teks */
            color: #4f46e5; /* Warna ungu untuk link */
            transition: color 0.3s ease; /* Transisi warna saat hover */
        }

        .register-link:hover {
            color: #d53f8c; /* Warna link berubah menjadi merah muda saat hover */
        }
    </style>
</head>
<body class="flex items-center justify-center min-h-screen">
    <div class="max-w-md w-full p-8 bg-white shadow-lg rounded-lg">
        <img src="wallpaperflare.com_wallpaper (3).jpg" alt="Background Image" class="absolute inset-0 w-full h-full object-cover rounded-lg opacity-30 z-0"> <!-- Gambar latar belakang dengan opacity -->
        <div class="relative z-10"> <!-- Konten form login yang diatur agar tidak tertutup oleh gambar -->
            <div class="text-center">
                <!-- Teks animasi -->
                <h1 class="text-2xl font-bold animated-text mb-2">🌟 Selamat Datang di Portal Data Kami! 🌟</h1>
                <h2 class="text-xl font-semibold animated-text">🔍 Temukan Beragam Informasi dan Data Terlengkap di Sini!</h2>
            </div>

            <!-- Menampilkan pesan error jika ada -->
            <?php if (isset($error)) { echo "<div class='bg-red-100 text-red-700 p-3 rounded-lg my-4'>$error</div>"; } ?>

            <!-- Form login -->
            <form action="login.php" method="POST" class="space-y-6">
                <div class="form-group">
                    <label class="block text-purple-700 font-semibold mb-1">Username:</label>
                    <input type="text" name="username" class="w-full px-4 py-2 border input-border rounded-lg focus:ring-2 focus:outline-none input-focus" required>
                </div>
                <div class="form-group">
                    <label class="block text-purple-700 font-semibold mb-1">Password:</label>
                    <input type="password" name="password" class="w-full px-4 py-2 border input-border rounded-lg focus:ring-2 focus:outline-none input-focus" required>
                </div>
                <button type="submit" class="w-full bg-purple-700 hover:bg-purple-800 text-white text-lg font-bold py-2 rounded-lg transition duration-300 ease-in-out animated-text">Login</button>
            </form>

            <!-- Link untuk register jika belum punya akun -->
            <p class="text-center mt-6 text-purple-700">Belum punya akun? <a href="register.php" class="register-link animated-text">Register</a></p>
        </div>
    </div>
</body>
</html>
