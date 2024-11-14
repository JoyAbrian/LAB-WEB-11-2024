<?php
include 'config\config.php';
session_start();

$error = '';

if (isset($_POST['login'])) {
    $nama = $_POST['nama'];
    $nim = $_POST['nim'];

    // Query untuk mencari user berdasarkan nama
    $query = $conn->prepare("SELECT * FROM mahasiswa WHERE nama = ?");
    $query->bind_param('s', $nama);
    $query->execute();
    $result = $query->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        // Verifikasi NIM
        if ($nim === $user['nim']) {
            $_SESSION['role'] = $user['role'];
            $_SESSION['nama'] = $user['nama'];
            $_SESSION['nim'] = $user['nim'];
            header('Location: index.php');
            exit;
        } else {
            $error = 'NIM salah!';
        }
    } else {
        $error = 'Nama tidak ditemukan!';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <div class="min-h-screen flex items-center justify-center">
        <div class="container max-w-md w-full p-6 rounded-lg shadow-md">
            <h2 class="text-2xl font-bold text-center mb-6" style="font-size: 40px">Welcome!</h2>
            <br>
            <?php if ($error) { ?>
                <p class="text-red-500 text-center mb-4"><?= $error; ?></p>
            <?php } ?>

            <form method="POST" action="">
                <div class="mb-4">
                    <label class="block text-gray-700 mb-2">Nama:</label>
                    <input type="text" name="nama" class="w-full p-2 border rounded" required>
                </div>
                <div class="mb-6">
                    <label class="block text-gray-700 mb-2">NIM:</label>
                    <input type="password" name="nim" class="w-full p-2 border rounded" required>
                </div>
                <button type="submit" name="login" class="w-full bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">
                    Login
                </button>
            </form>

            <p class="mt-4 text-center text-gray-600">
                Belum punya akun? 
                <a href="register.php" class="text-blue-500 hover:text-blue-600">Daftar disini</a>
            </p>
        </div>
    </div>
</body>
</html>