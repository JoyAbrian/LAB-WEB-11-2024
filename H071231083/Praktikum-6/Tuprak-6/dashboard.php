<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

$users = [
    [
        'name' => 'Ikhsan Saputra',
        'username' => 'Sanz',
        'email' => 'ikhsan@gmail.com',
        'password' => password_hash('ikhsan123', PASSWORD_DEFAULT),
        'gender' => 'Male',
        'faculty' => 'Teknik',
        'batch' => '2023',
    ],
    [
        'name' => 'Muhammad Dirga',
        'username' => 'Digo',
        'email' => 'digo@gmail.com',
        'password' => password_hash('digo123', PASSWORD_DEFAULT),
        'gender' => 'Male',
        'faculty' => 'Mipa',
        'batch' => '2022',
    ],
    [
        'name' => 'Kevin Ardhana',
        'username' => 'Vindes',
        'email' => 'kevin@gmail.com',
        'password' => password_hash('kevin123', PASSWORD_DEFAULT),
        'gender' => 'Male',
        'faculty' => 'Hukum',
        'batch' => '2019',
    ],
    [
        'name' => 'Nur Adzan',
        'username' => 'Nucas',
        'email' => 'adzan@gmail.com',
        'password' => password_hash('adzan123', PASSWORD_DEFAULT),
        'gender' => 'Male',
        'faculty' => 'FISIP',
        'batch' => '2024',
    ],
    [
        'name' => 'Mikran Hidayat',
        'username' => 'Mike',
        'email' => 'mikran@gmail.com',
        'password' => password_hash('mikran123', PASSWORD_DEFAULT),
        'gender' => 'Male',
        'faculty' => 'FIKP',
        'batch' => '2021',
    ],
];

if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: login.php');
    exit;
}
 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif; /* Menggunakan font modern */
            font-size: 18px;
            line-height: 1.6;
            margin: 0;
            padding: 20px;
            background-image: url('image/gambar2.gif');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center center;
            background-attachment: fixed;
            color: #4FCCA3; /* Warna teks hijau mint */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            backdrop-filter: blur(5px); /* Efek blur pada background */
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            background: linear-gradient(135deg, rgba(28, 28, 30, 0.9), rgba(58, 63, 71, 0.9)); /* Gradasi gelap: hitam dan abu-abu gelap */
            padding: 40px; /* Memperbesar padding untuk estetika */
            border-radius: 15px; /* Membuat sudut lebih bulat */
            box-shadow: 0 0 30px rgba(0, 0, 0, 0.5); /* Efek bayangan lebih lembut */
            /* Blur tambahan untuk kontainer */
            transition: transform 0.3s ease;
        }

        .container:hover {
            transform: scale(1.02); /* Efek pembesaran saat hover */
        }

        h1, h2, p {
            color: #4FCCA3; /* Warna teks hijau mint */
            text-align: left;
            text-shadow: 0 0 10px rgba(79, 204, 163, 0.8); /* Efek bayangan pada teks */
        }

        input[type="submit"], .logout {
            background: linear-gradient(135deg, #1A1A1A, #444); /* Gradasi gelap untuk tombol */
            color: #4FCCA3; /* Warna teks hijau mint */
            border: none;
            padding: 12px 25px; /* Memperbesar padding untuk estetika */
            cursor: pointer;
            border-radius: 8px; /* Membulatkan sudut */
            transition: all 0.3s ease;
            font-size: 16px;
        }

        input[type="submit"]:hover, .logout:hover {
            background-color: #2F2F2F; /* Warna gelap saat hover */
            color: #4FCCA3; /* Warna teks tetap hijau mint */
            box-shadow: 0 0 30px rgba(79, 204, 163, 0.8); /* Efek bayangan lebih besar */
            transform: translateY(-3px); /* Efek naik saat hover */
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 12px 13px; /* Padding lebih besar */
            border: 2.5px solid #4A4A4A;
            text-align: center;
            font-size: 14px; /* Ukuran font lebih besar */
            /* white-space: nowrap; */
        }

        th {
            background-color: #4fcca3; /* Warna hijau mint */
            color: #1A1A1A; /* Warna teks hitam */
            font-weight: bold;
            letter-spacing: 1px; /* Menambah jarak antar huruf */
            /* Huruf kapital untuk heading tabel */
        }

        td {
            background-color: rgba(28, 28, 30, 0.9); /* Warna gelap untuk sel tabel */
            color: #4FCCA3; /* Warna teks hijau mint */
        }

        .error {
            color: #f44336; /* Warna merah untuk pesan error */
            background-color: rgba(244, 67, 54, 0.1); /* Latar belakang error yang ringan */
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 10px;
        }

        a.logout {
            text-decoration: none; /* Menghilangkan garis bawah */
            display: inline-block; /* Membuat tombol logout terlihat seperti tombol */
            padding: 12px 25px; /* Padding lebih besar untuk tombol logout */
            background: linear-gradient(135deg, #1A1A1A, #444); /* Gradasi gelap untuk tombol logout */
            color: #4FCCA3; /* Warna teks hijau mint */
            border-radius: 8px; /* Membulatkan sudut */
            transition: all 0.3s ease;
            font-size: 16px;
        }

        a.logout:hover {
            background-color: #2F2F2F; /* Warna lebih terang saat hover */
            color: #4FCCA3; /* Warna teks tetap hijau mint */
            box-shadow: 0 0 30px rgba(79, 204, 163, 0.8); /* Efek bayangan saat hover */
            transform: translateY(-3px); /* Efek naik saat hover */
        }


        @media (max-width: 768px) {
        table {
            display: block; /* Mengubah tabel menjadi block */
            overflow-x: auto; /* Menambahkan scrollbar horizontal */
            white-space: nowrap; /* Mencegah pembungkusan teks */
            }

        th, td {
            font-size: 12px; /* Ukuran font lebih kecil untuk layar kecil */
            padding: 10px; /* Menyesuaikan padding */
        }
    }

        @media (max-width: 480px) {
        table {
            display: block; /* Tetap dalam bentuk block */
            overflow-x: auto; /* Menambahkan scrollbar horizontal */
        }

        th, td {
            display: block; /* Mengubah sel menjadi block untuk responsivitas */
            text-align: left; /* Menyesuaikan teks untuk sel */
            border: none; /* Menghapus border */
            padding: 10px 0; /* Padding yang lebih kecil */
        }

        th {
            display: none; /* Menyembunyikan header tabel pada layar kecil */
        }

        td {
            border-bottom: 1px solid #4A4A4A; /* Menambahkan garis bawah untuk pemisahan */
            position: relative; /* Memungkinkan untuk menambahkan elemen pseudo */
            padding-left: 50%; /* Memberi ruang di kiri untuk elemen pseudo */
        }

        td::before {
            content: attr(data-label); /* Menggunakan atribut data untuk menampilkan label */
            position: absolute; /* Mengatur posisi label */
            left: 10px; /* Jarak dari kiri */
            font-weight: bold; /* Menebalkan label */
            color: #4FCCA3; /* Warna label */
        }
    }
    </style>
</head>
<body>
    <!-- Tampilan setelah login -->
    <div class="container">
        <h1>Welcome, <?php echo $_SESSION['user']['name']; ?>!</h1>
        <p>Email: <?php echo $_SESSION['user']['email']; ?></p>
        <p>Username: <?php echo $_SESSION['user']['username']; ?></p>
        <?php if ($_SESSION['user']['name'] != 'Admin'): ?>
            <p>Gender: <?php echo $_SESSION['user']['gender']; ?></p>
            <p>Faculty: <?php echo $_SESSION['user']['faculty']; ?></p>
            <p>Batch: <?php echo $_SESSION['user']['batch']; ?></p>
        <?php else: ?>
            <h2>All Users</h2>
            <table>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Username</th>
                    <th>Gender</th>
                    <th>Faculty</th>
                    <th>Batch</th>
                </tr>
                <?php foreach ($users as $user): ?>
                    <?php if ($user['name'] != 'Admin'): ?>
                        <tr>
                            <td><?php echo $user['name']; ?></td>
                            <td><?php echo $user['email']; ?></td>
                            <td><?php echo $user['username']; ?></td>
                            <td><?php echo $user['gender']; ?></td>
                            <td><?php echo $user['faculty']; ?></td>
                            <td><?php echo $user['batch']; ?></td>
                        </tr>
                    <?php endif; ?>
                <?php endforeach; ?>
            </table>
        <?php endif; ?>
        <br>
        <a href="?logout" class="logout">Logout</a>
    </div>
</body>
</html>
