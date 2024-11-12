<?php
include 'config\config.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nim = trim($_POST['nim']);
    $nama = trim($_POST['nama']);
    $prodi = trim($_POST['prodi']);
    $role = trim($_POST['role']);

    // Validasi input
    if (empty($nim) || empty($nama) || empty($prodi) || empty($role)) {
        $error = "Semua kolom harus diisi!";
    } else {
        // Cek apakah NIM sudah terdaftar
        $checkQuery = $conn->prepare("SELECT * FROM mahasiswa WHERE nim = ?");
        $checkQuery->bind_param('s', $nim);
        $checkQuery->execute();
        $checkResult = $checkQuery->get_result();

        if ($checkResult->num_rows > 0) {
            $error = "NIM sudah terdaftar!";
        } else {
            // Secara default, role adalah 'mahasiswa'
            // $role = 'mahasiswa';

            // Masukkan data baru ke dalam tabel mahasiswa
            $query = $conn->prepare("INSERT INTO mahasiswa (nim, nama, prodi, role) VALUES (?, ?, ?, ?)");
            $query->bind_param('ssss', $nim, $nama, $prodi, $role);

            if ($query->execute()) {
                $_SESSION['success'] = "Pendaftaran berhasil! Silakan login menggunakan NIM Anda.";
                header('Location: login.php');
                exit;
            } else {
                $error = "Terjadi kesalahan saat mendaftarkan pengguna!";
            }
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
    <link rel="stylesheet" href="register.css">
</head>

<body>
    <div class="container max-w-md w-full p-6 rounded-lg shadow-md">
        <?php if (isset($error)) { ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline"><?php echo $error; ?></span>
            </div>
        <?php } ?>

        <form method="POST" action="" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            <h2 class="text-xl font-bold mb-4 text-center">Register Mahasiswa</h2>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="nim">
                    NIM:
                </label>
                <input
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    type="text" name="nim" required>
                <p class="text-gray-600 text-xs italic mt-1">NIM akan digunakan sebagai username dan password untuk
                    login</p>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="nama">
                    Nama:
                </label>
                <input
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    type="text" name="nama" required>
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="prodi">
                    Program Studi:
                </label>
                <input
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    type="text" name="prodi" required>
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="role">
                    Status:
                </label>
                <select name="role"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    required>
                    <option value="mahasiswa">Mahasiswa</option>
                    <option value="admin">Admin</option>
                </select>
            </div>


            <div class="flex items-center justify-between">
                <button
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                    type="submit">
                    Register
                </button>
                <a class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800"
                    href="login.php">
                    Sudah punya akun? Login
                </a>
            </div>
        </form>
    </div>
</body>

</html>