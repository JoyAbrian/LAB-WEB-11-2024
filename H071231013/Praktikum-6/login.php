<?php
session_start(); // Memulai sesi untuk menyimpan informasi pengguna yang terautentikasi

// Simulasi data user
$users = [
    [
        'email' => 'admin@gmail.com',
        'username' => 'adminxxx',
        'name' => 'Admin',
        'password' => password_hash('admin123', PASSWORD_DEFAULT), // Menghitung hash password untuk keamanan
    ],
    [
        'email' => 'nanda@gmail.com',
        'username' => 'nanda_aja',
        'name' => 'Wd. Ananda Lesmono',
        'password' => password_hash('nanda123', PASSWORD_DEFAULT), // Menghitung hash password untuk keamanan
        'gender' => 'Female',
        'faculty' => 'MIPA',
        'batch' => '2021',
    ],
    [
        'email' => 'arif@gmail.com',
        'username' => 'arif_nich',
        'name' => 'Muhammad Arief',
        'password' => password_hash('arief123', PASSWORD_DEFAULT), // Menghitung hash password untuk keamanan
        'gender' => 'Male',
        'faculty' => 'Hukum',
        'batch' => '2021',
    ],
    [
        'email' => 'eka@gmail.com',
        'username' => 'eka59',
        'name' => 'Eka Hanny',
        'password' => password_hash('eka123', PASSWORD_DEFAULT), // Menghitung hash password untuk keamanan
        'gender' => 'Female',
        'faculty' => 'Keperawatan',
        'batch' => '2021',
    ],
    [
        'email' => 'adnan@gmail.com',
        'username' => 'adnan72',
        'name' => 'Adnan',
        'password' => password_hash('adnan123', PASSWORD_DEFAULT), // Menghitung hash password untuk keamanan
        'gender' => 'Male',
        'faculty' => 'Teknik',
        'batch' => '2020',
    ]
];

// Proses login
if ($_SERVER['REQUEST_METHOD'] == 'POST') { // Memeriksa jika permintaan adalah metode POST
    $username = $_POST['username']; // Mengambil username/email dari form
    $passwordInput = $_POST['password_input']; // Mengambil password dari input

    foreach ($users as $user) { // Iterasi melalui data pengguna
        // Memeriksa apakah username/email dan password cocok
        if (($user['username'] == $username || $user['email'] == $username) && password_verify($passwordInput, $user['password'])) {
            // Set session jika login berhasil
            $_SESSION['user'] = $user;
            if ($user['username']== "adminxxx") {
                header("Location: dashboard.php"); // Mengarahkan pengguna ke dashboard setelah login
                exit(); // Menghentikan eksekusi script setelah redirect
            } else {
                header("location: dashboarduser.php");
                exit();
            }
        }
    }
    // Jika gagal login
    $error = "Username atau password salah!"; // Pesan error jika login gagal
} else {
    // Jika tidak login, inisialisasi username
    $username = ''; // Mengatur username kosong jika tidak ada input
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #e74c3c; /* Merah */
            display: flex; /* Menggunakan Flexbox untuk pusat konten */
            justify-content: center; /* Mengatur konten ke tengah secara horizontal */
            align-items: center; /* Mengatur konten ke tengah secara vertikal */
            height: 100vh; /* Mengatur tinggi body ke 100% dari viewport */
            margin: 0; /* Menghapus margin default */
            transition: background-color 0.3s; /* Transisi halus untuk perubahan warna latar belakang */
        }

        .container {
            max-width: 400px; /* Mengatur lebar maksimum kontainer */
            background-color: #2ecc71; /* Hijau */
            padding: 30px; /* Padding di dalam kontainer */
            border-radius: 10px; /* Sudut melengkung */
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2); /* Menambahkan bayangan untuk efek kedalaman */
            transition: background-color 0.3s; /* Transisi warna */
        }

        .container h2 {
            text-align: center; /* Menempatkan teks di tengah */
            color: white; /* Putih */
            margin-bottom: 20px; /* Margin di bawah judul */
        }

        .error-message {
            color: #c0392b; /* Merah gelap untuk pesan error */
            text-align: center; /* Menempatkan pesan di tengah */
            margin-bottom: 15px; /* Margin di bawah pesan error */
        }

        .form-input {
            position: relative; /* Mengatur posisi relatif untuk elemen input */
        }

        .form-input i {
            position: absolute; /* Menempatkan ikon secara absolut */
            left: 10px; /* Mengatur posisi ikon ke kiri */
            top: 50%; /* Menempatkan ikon di tengah vertikal */
            transform: translateY(-50%); /* Menggeser ikon ke tengah vertikal */
            color: #fff; /* Putih */
        }

        .form-input input {
            width: 100%; /* Mengatur lebar input 100% */
            padding: 10px 15px; /* Padding dalam input */
            border: 1px solid #dfe6e9; /* Warna border */
            border-radius: 8px; /* Sudut melengkung */
            margin-bottom: 15px; /* Margin di bawah input */
            transition: 0.3s; /* Transisi halus untuk border */
            background-color: white; /* Putih */
            color: #333; /* Hitam */
        }

        .form-input input:focus {
            border-color: #27ae60; /* Hijau lebih gelap saat fokus */
            box-shadow: 0 0 5px rgba(39, 174, 96, 0.5); /* Bayangan saat fokus */
            outline: none; /* Menghapus outline default */
        }

        .submit-btn {
            background-color: #c0392b; /* Merah gelap untuk tombol submit */
            color: white; /* Putih */
            padding: 12px; /* Padding untuk tombol */
            width: 100%; /* Mengatur lebar tombol 100% */
            border: none; /* Menghapus border default */
            border-radius: 8px; /* Sudut melengkung */
            font-size: 16px; /* Ukuran font */
            cursor: pointer; /* Menampilkan kursor pointer saat hover */
            transition: background-color 0.3s; /* Transisi warna latar belakang */
        }

        .submit-btn:hover {
            background-color: #a93226; /* Merah lebih gelap saat hover */
        }

        .toggle-btn {
            background-color: #27ae60; /* Hijau untuk tombol toggle */
            color: white; /* Putih */
            padding: 12px; /* Padding untuk tombol */
            width: 100%; /* Mengatur lebar tombol 100% */
            border: none; /* Menghapus border default */
            border-radius: 8px; /* Sudut melengkung */
            font-size: 16px; /* Ukuran font */
            cursor: pointer; /* Menampilkan kursor pointer saat hover */
            margin-top: 15px; /* Margin di atas tombol */
            transition: background-color 0.3s, transform 0.2s; /* Transisi untuk warna dan transformasi */
        }

        .toggle-btn:hover {
            background-color: #219653; /* Hijau lebih gelap saat hover */
        }

        .toggle-btn.active {
            background-color: #e67e22; /* Warna saat tombol aktif (oren) */
            transform: scale(1.05); /* Efek zoom saat aktif */
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>Login</h2> <!-- Judul halaman login -->

        <!-- Error Message -->
        <?php if (isset($error)): ?> <!-- Memeriksa apakah ada pesan error -->
            <p class="error-message"><?= $error; ?></p> <!-- Menampilkan pesan error -->
        <?php endif; ?>

        <!-- Form Input -->
        <form action="" method="POST"> <!-- Form dengan metode POST -->
            <div class="form-input">
                <i class="fas fa-user"></i> <!-- Ikon untuk input username/email -->
                <input type="text" name="username" placeholder="Username atau Email" value="<?= htmlspecialchars($username); ?>" required> <!-- Input untuk username atau email -->
            </div>
            
            <div class="form-input">
                <i class="fas fa-lock"></i> <!-- Ikon untuk input password -->
                <input type="password" name="password_input" placeholder="Password" required> <!-- Input untuk password -->
            </div>

            <button type="submit" class="submit-btn">Login</button> <!-- Tombol submit untuk login -->
        </form>
    </div>
    
    <script src="https://kit.fontawesome.com/a076d05399.js"></script> <!-- Menggunakan Font Awesome untuk ikon -->
</body>
</html>
