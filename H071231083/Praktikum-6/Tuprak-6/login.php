<?php
session_start();

// Data pengguna admin
$users = [
    [
        'email' => 'admin@gmail.com',
        'username' => 'adminxxx',
        'name' => 'Admin',
        'password' => password_hash('admin123', PASSWORD_DEFAULT),
    ],
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

// Fungsi untuk mencocokkan email/username dan password
function authenticate($email_or_username, $password) {
    global $users; 
    foreach ($users as $user) {
        if (($user['email'] == $email_or_username || $user['username'] == $email_or_username) && 
            password_verify($password, $user['password'])) {
            return $user;
        }
    }
    return null;
}
 
// Proses login
if (isset($_POST['login'])) {
    $user = authenticate($_POST['email_or_username'], $_POST['password']);
    if ($user) {
        $_SESSION['user'] = $user;
        header('Location: dashboard.php');
        exit;
    } else {
        $error = "Invalid credentials!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            font-family: 'Poppins', Arial, sans-serif; Menggunakan font modern
            line-height: 1.6;
            margin: 0;
            padding: 20px;
            background-image: url('image/gambar1.gif');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center center;
            background-attachment: fixed;
            color: #4FCCA3;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            backdrop-filter: blur(5px);
        }

        .container {
            max-width: 700px;
            width: 40%;
            margin: 0 auto;
            background: linear-gradient(135deg, rgba(28, 28, 30, 0.9), rgba(58, 63, 71, 0.9)); /* Gradasi gelap: hitam dan abu-abu gelap */
            padding: 60px;
            border-radius: 25px; /* Membuat sudut lebih bulat untuk tampilan lembut */
            box-shadow: 0 0 30px rgba(0, 0, 0, 0.5);
            transition: transform 0.3s ease;
        }

        .container:hover {
            transform: scale(1.02); /* Efek pembesaran saat hover */
        }

        h1, h2, p {
            color: #4FCCA3;
            text-align: center;
            text-shadow: 0 0 10px rgba(79, 204, 163, 0.7); /* Efek bayangan pada teks */
        }

        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 15px;
            margin-bottom: 15px; /* Memberikan ruang lebih antara input */
            border: 1px solid #ddd;
            border-radius: 7px;
            background-color: #1A1A1A;
            color: #4FCCA3;
            box-shadow: inset 0 0 10px rgba(0, 0, 0, 0.5); /* Bayangan dalam untuk input */
            transition: all 0.3s ease; /* Transisi saat input berubah */
        }

        input[type="text"]:focus, input[type="password"]:focus {
            background-color: #333;
            border-color: #4FCCA3;
            box-shadow: 0 0 10px rgba(79, 204, 163, 0.8); /* Efek glow saat fokus */
            outline: none;
        }

        input[type="submit"], .logout {
            background: linear-gradient(135deg, #1A1A1A, #444); /* Gradasi gelap: hitam dan abu-abu gelap */
            color: #4FCCA3;
            border: none;
            padding: 12px 25px; /* Memperbesar padding */
            cursor: pointer;
            border-radius: 8px; /* Sudut lebih bulat untuk tombol */
            transition: all 0.3s ease;
            font-size: 16px;
        }

        input[type="submit"]:hover, .logout:hover {
            background: #2F2F2F; /* Warna gelap saat hover */
            color: #4FCCA3;
            box-shadow: 0 0 30px rgba(0, 0, 0, 0.8); /* Bayangan lebih besar saat hover */
            transform: translateY(-3px); /* Efek naik saat hover */
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 12px 15px; /* Padding lebih besar */
            border: 1px solid #ddd;
            text-align: left;
            font-size: 16px; /* Ukuran font lebih besar */
        }

        th {
            background-color: #4FCCA3;
            color: #1A1A1A;
            font-weight: bold;
            letter-spacing: 1px; /* Menambah jarak antar huruf */
            text-transform: uppercase; /* Huruf kapital untuk heading tabel */
        }

        td {
            background-color: rgba(28, 28, 30, 0.8); /* Warna gelap untuk sel tabel */
            color: #4FCCA3;
        }

        .error {
            color: #f44; /* Warna merah untuk pesan error */
            width: 102%;
            background-color: rgba(244, 67, 54, 0.1);
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 10px;
        }

        a.logout {
            text-decoration: none;
            display: inline-block;
            padding: 12px 25px;
            background: linear-gradient(135deg, #1A1A1A, #444); /* Gradasi gelap untuk tombol logout */
            color: #4FCCA3;
            border-radius: 8px;
            transition: all 0.3s ease;
            font-size: 16px;
        }

        a.logout:hover {
            background-color: #2F2F2F;
            color: #4FCCA3;
            box-shadow: 0 0 30px rgba(0, 0, 0, 0.8);
            transform: translateY(-3px);
        }
    </style>
</head>
<body>
    <!-- Tampilan halaman login -->
    <div class="container">
        <?php if (!isset($_SESSION['user'])): ?>
            <h1>LOGIN</h1>
            <?php if (isset($error)): ?>
                <p class="error"><?php echo $error; ?></p>
            <?php endif; ?>
            <form method="post">
                <input type="text" name="email_or_username" placeholder="Email or Username" required><br>
                <input type="password" name="password" placeholder="Password" required><br>
                <input type="submit" name="login" value="Submit">
            </form>
            <p style="text-align: left; margin-top: 10px;">
                Don't have an account? 
            <a href="register.php" style="color: #4FCCA3; text-decoration: underline;">
                Register here.
            </a>
            </p>
        <?php endif; ?>
    </div>
</body>
</html>