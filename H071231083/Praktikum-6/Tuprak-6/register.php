<?php
session_start();

// Data pengguna
$users = [
    [
        'email' => 'admin@gmail.com',
        'username' => 'adminxxx',
        'name' => 'Admin',
        'password' => password_hash('admin123', PASSWORD_DEFAULT),
    ],
    
];
// Fungsi untuk memeriksa apakah email atau username sudah digunakan
function is_existing_user($email, $username) {
    global $users;
    foreach ($users as $user) {
        if ($user['email'] === $email || $user['username'] === $username) {
            return true;
        }
    }
    return false;
}

// Fungsi untuk menambahkan pengguna baru
function register_user($name, $username, $email, $password, $gender, $faculty, $bacth) {
    global $users;
    $new_user = [
        'name' => $name,
        'username' => $username,
        'email' => $email,
        'password' => password_hash($password, PASSWORD_DEFAULT),
        'gender' => $gender,
        'faculty' => $faculty,
        'batch' => $batch
    ];
    $users[] = $new_user;
}

// Jika form pendaftaran dikirim
if (isset($_POST['register'])) {
    $name = $_POST['name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $gender = $_POST['gender'];
    $faculty = $_POST['faculty'];
    $batch = $_POST['batch'];

    // Cek apakah email atau username sudah digunakan
    if (is_existing_user($email, $username)) {
        $error = "Email atau Username sudah digunakan!";
    } else {
        // Daftarkan pengguna baru
        register_user($name, $username, $email, $password, $gender, $faculty, $batch);
        $_SESSION['user'] = [
            'name' => $name,
            'username' => $username,
            'email' => $email,
            'gender' => $gender,
            'faculty' => $faculty,
            'batch' => $batch
        ];
        header('Location: dashboard.php');
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
        body {
            font-family: 'Poppins', Arial, sans-serif;
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
            background: linear-gradient(135deg, rgba(28, 28, 30, 0.9), rgba(58, 63, 71, 0.9));
            padding: 60px;
            border-radius: 25px;
            box-shadow: 0 0 30px rgba(0, 0, 0, 0.5);
            transition: transform 0.3s ease;
        }

        .container:hover {
            transform: scale(1.02);
        }

        h1, h2, p {
            color: #4FCCA3;
            text-align: center;
            text-shadow: 0 0 10px rgba(79, 204, 163, 0.7);
        }

        input[type="text"], input[type="email"], input[type="password"], select {
            width: 100%;
            padding: 15px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 7px;
            background-color: #1A1A1A;
            color: #4FCCA3;
            box-shadow: inset 0 0 10px rgba(0, 0, 0, 0.5);
            transition: all 0.3s ease;
        }

        input[type="text"]:focus, input[type="email"]:focus, input[type="password"]:focus, select:focus {
            background-color: #333;
            border-color: #4FCCA3;
            box-shadow: 0 0 10px rgba(79, 204, 163, 0.8);
            outline: none;
        }

        input[type="submit"] {
            background: linear-gradient(135deg, #1A1A1A, #444);
            color: #4FCCA3;
            border: none;
            padding: 12px 25px;
            cursor: pointer;
            border-radius: 8px;
            transition: all 0.3s ease;
            font-size: 16px;
        }

        input[type="submit"]:hover {
            background: #2F2F2F;
            color: #4FCCA3;
            box-shadow: 0 0 30px rgba(0, 0, 0, 0.8);
            transform: translateY(-3px);
        }

        .error {
            color: #f44;
            width: 102%;
            background-color: rgba(244, 67, 54, 0.1);
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
<div class="container">
        <h1>Register</h1>
        <?php if (!empty($errors)): ?>
            <div class="error">
                <?php foreach ($errors as $error): ?>
                    <p><?php echo htmlspecialchars($error); ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        <form method="post">
            <input type="text" name="name" placeholder="Full Name" required><br>
            <input type="text" name="username" placeholder="Username" required><br>
            <input type="email" name="email" placeholder="Email" required><br>
            <input type="password" name="password" placeholder="Password" required><br>
            <select name="gender" required>
                <option value="">Select Gender</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
            </select><br>
            <select name="faculty" required>
                <option value="">Select Faculty</option>
                <option value="Mipa">Mipa</option>
                <option value="Hukum">Hukum</option>
                <option value="Teknik">Teknik</option>
                <option value="Kedokteran">Kedokteran</option>
                <option value="FKM">FKM</option>
                <option value="FKG">FKG</option>
                <option value="Keperawatan">Keperawatan</option>
                <option value="FIB">FIB</option>
                <option value="FEB">FEB</option>
                <option value="FISIP">FISIP</option>
                <option value="Kehutanan">Kehutanan</option>
                <option value="Peternakan">Peternakan</option>
                <option value="Pertanian">Pertanian</option>
                <option value="Farmasi">Farmasi</option>
                <option value="Vokasi">Vokasi</option>
                <option value="FIKP">FIKP</option>
            </select><br>
            <input type="text" name="batch" placeholder="Batch" required><br>
            <input type="submit" name="register" value="Register">
        </form>
        <p style="text-align: center; margin-top: 10px;">
            Already have an account?
        </p>
    </div>
</body>
</html>
