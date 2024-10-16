<?php
session_start(); // Memulai sesi pengguna

// Alihkan ke halaman login jika pengguna tidak masuk
if (!isset($_SESSION['user'])) { // Memeriksa apakah sesi pengguna ada
    header("Location: index.php"); // Jika tidak ada, redirect ke halaman login
    exit(); // Menghentikan eksekusi lebih lanjut
}

// Ambil data pengguna dari sesi
$user = $_SESSION['user']; // Mengambil data pengguna dari sesi

// Logout functionality
if (isset($_GET['logout'])) { // Memeriksa apakah ada permintaan logout
    session_destroy(); // Menghancurkan sesi yang ada
    header("Location: index.php"); // Redirect ke halaman login
    exit(); // Menghentikan eksekusi lebih lanjut
}

// Daftar hobby dan lokasi
$hobbies = ['Reading', 'Football', 'Cooking', 'Gaming', 'Traveling', 'Swimming', 'Drawing', 'Hiking']; // Daftar hobi
$locations = ['Jakarta', 'Bandung', 'Yogyakarta', 'Surabaya', 'Medan', 'Bali', 'Malang', 'Semarang']; // Daftar lokasi

// Simulasi data user
$users = [ // Array yang berisi data pengguna yang berbeda
    [
        'email' => 'admin@gmail.com',
        'username' => 'adminxxx',
        'name' => 'Admin',
        'password' => password_hash('admin123', PASSWORD_DEFAULT), // Mengamankan password dengan hashing
        'gender' => 'Male',
        'faculty' => 'Informatika',
        'batch' => '2020',
        'age' => rand(25, 30), // Usia acak antara 25 dan 30
        'hobby' => $hobbies[array_rand($hobbies)], // Hobi acak dari daftar
        'location' => $locations[array_rand($locations)], // Lokasi acak dari daftar
    ],
    [
        'email' => 'nanda@gmail.com',
        'username' => 'nanda_aja',
        'name' => 'Wd. Ananda Lesmono',
        'password' => password_hash('nanda123', PASSWORD_DEFAULT), // Mengamankan password dengan hashing
        'gender' => 'Female',
        'faculty' => 'MIPA',
        'batch' => '2021',
        'age' => rand(20, 25), // Usia acak antara 20 dan 25
        'hobby' => $hobbies[array_rand($hobbies)], // Hobi acak dari daftar
        'location' => $locations[array_rand($locations)], // Lokasi acak dari daftar
    ],
    [
        'email' => 'arif@gmail.com',
        'username' => 'arif_nich',
        'name' => 'Muhammad Arief',
        'password' => password_hash('arief123', PASSWORD_DEFAULT), // Mengamankan password dengan hashing
        'gender' => 'Male',
        'faculty' => 'Hukum',
        'batch' => '2021',
        'age' => rand(20, 25), // Usia acak antara 20 dan 25
        'hobby' => $hobbies[array_rand($hobbies)], // Hobi acak dari daftar
        'location' => $locations[array_rand($locations)], // Lokasi acak dari daftar
    ],
    [
        'email' => 'eka@gmail.com',
        'username' => 'eka59',
        'name' => 'Eka Hanny',
        'password' => password_hash('eka123', PASSWORD_DEFAULT), // Mengamankan password dengan hashing
        'gender' => 'Female',
        'faculty' => 'Keperawatan',
        'batch' => '2021',
        'age' => rand(20, 25), // Usia acak antara 20 dan 25
        'hobby' => $hobbies[array_rand($hobbies)], // Hobi acak dari daftar
        'location' => $locations[array_rand($locations)], // Lokasi acak dari daftar
    ],
    [
        'email' => 'adnan@gmail.com',
        'username' => 'adnan72',
        'name' => 'Adnan',
        'password' => password_hash('adnan123', PASSWORD_DEFAULT), // Mengamankan password dengan hashing
        'gender' => 'Male',
        'faculty' => 'Teknik',
        'batch' => '2020',
        'age' => rand(20, 25), // Usia acak antara 20 dan 25
        'hobby' => $hobbies[array_rand($hobbies)], // Hobi acak dari daftar
        'location' => $locations[array_rand($locations)], // Lokasi acak dari daftar
    ],
];

// Menentukan data untuk pengguna yang sedang login
$currentUser = null; // Variabel untuk menyimpan data pengguna yang sedang login
foreach ($users as $u) { // Iterasi melalui array pengguna
    if ($u['username'] === $user['username']) { // Mencocokkan username
        $currentUser = $u; // Menyimpan data pengguna yang cocok
        break; // Keluar dari loop setelah menemukan pengguna
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"> <!-- Menentukan charset dokumen -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Mengatur viewport untuk responsivitas -->
    <title>Dashboard User</title> <!-- Judul halaman -->
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 20px; background-color: #fff9c4; transition: background-color 0.5s; } /* Ganti latar belakang menjadi kuning dengan transisi */
        .dashboard { max-width: 800px; margin: 0 auto; background-color: #ffffff; padding: 20px; border-radius: 5px; box-shadow: 0 0 10px rgba(0,0,0,0.1); } /* Gaya untuk kontainer dashboard */
        h1 { margin-top: 0; border-bottom: 1px solid #c0e6d4; padding-bottom: 10px; color: #3fbb4c; transition: color 0.5s; } /* Ganti warna teks judul h1 menjadi hijau dengan transisi */
        h2 { margin-bottom: 20px; color: #3fbb4c; transition: color 0.5s; } /* Ganti warna teks judul h2 menjadi hijau dengan transisi */
        p { margin: 5px 0; color: #333; } /* Gaya untuk paragraf */
        .logout-btn { display: inline-block; background-color: #3fbb4c; color: #fff; padding: 10px 15px; text-decoration: none; border-radius: 5px; border: none; cursor: pointer; } /* Ganti warna tombol logout menjadi hijau */
        .logout-btn:hover { background-color: #2b7a3b; } /* Gaya saat hover pada tombol logout */
    </style>
</head>
<body>
    <div class="dashboard"> <!-- Kontainer untuk dashboard pengguna -->
        <h1>Dashboard User</h1> <!-- Judul dashboard -->
        <h2>Welcome, <?= htmlspecialchars($currentUser['name']); ?>!</h2> <!-- Menyambut pengguna dengan nama mereka -->
        <p><strong>Email:</strong> <?= htmlspecialchars($currentUser['email']); ?></p> <!-- Menampilkan email pengguna -->
        <p><strong>Username:</strong> <?= htmlspecialchars($currentUser['username']); ?></p> <!-- Menampilkan username pengguna -->
        <?php if (isset($currentUser['gender'])): ?> <!-- Memeriksa apakah gender ada -->
            <p><strong>Gender:</strong> <?= htmlspecialchars($currentUser['gender']); ?></p> <!-- Menampilkan gender pengguna -->
        <?php endif; ?>
        <p><strong>Faculty:</strong> <?= htmlspecialchars($currentUser['faculty'] ?? 'N/A'); ?></p> <!-- Menampilkan fakultas pengguna, atau 'N/A' jika tidak ada -->
        <p><strong>Batch:</strong> <?= htmlspecialchars($currentUser['batch'] ?? 'N/A'); ?></p> <!-- Menampilkan batch pengguna, atau 'N/A' jika tidak ada -->
        <p><strong>Age:</strong> <?= htmlspecialchars($currentUser['age'] ?? 'N/A'); ?></p> <!-- Menampilkan usia pengguna, atau 'N/A' jika tidak ada -->
        <p><strong>Hobby:</strong> <?= htmlspecialchars($currentUser['hobby'] ?? 'N/A'); ?></p> <!-- Menampilkan hobi pengguna, atau 'N/A' jika tidak ada -->
        <p><strong>Location:</strong> <?= htmlspecialchars($currentUser['location'] ?? 'N/A'); ?></p> <!-- Menampilkan lokasi pengguna, atau 'N/A' jika tidak ada -->

        <a href="?logout=1" class="logout-btn">Logout</a> <!-- Tombol Logout -->
    </div>

    <script>
        // Daftar warna untuk latar belakang
        const colors = ['#fff9c4', '#cfd8dc', '#f0f4c3', '#e1bee7', '#ffccbc', '#b2ebf2'];
        let currentIndex = 0;

        // Fungsi untuk mengubah warna latar belakang
        function changeBackgroundColor() {
            document.body.style.backgroundColor = colors[currentIndex];
            currentIndex = (currentIndex + 1) % colors.length; // Mengubah index warna
        }

        // Mengganti warna setiap 3 detik
        setInterval(changeBackgroundColor, 3000);
    </script>
</body>
</html>
