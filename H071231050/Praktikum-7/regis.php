<?php

session_start();
include 'conn.php';
$errors = [];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $role = 'mahasiswa';

    if (empty($username)) {
        $errors[] = "Username tidak boleh kosong";
    } elseif (strlen($username) < 4) {
        $errors[] = "Username minimal 4 karakter";
    } else {
        $stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        if ($stmt->get_result()->num_rows > 0) {
            $errors[] = "Username sudah digunakan";
        }
    }

    if (empty($password)) {
        $errors[] = "Password tidak boleh kosong";
    } elseif (strlen($password) < 6) {
        $errors[] = "Password minimal 6 karakter";
    } elseif ($password !== $confirm_password) {
        $errors[] = "Konfirmasi password tidak cocok";
    }

    if (empty($errors)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $conn->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $hashed_password, $role);

        if ($stmt->execute()) {
            echo "<script>alert('Pendaftaran berhasil!'); window.location.href = 'login.php';</script>";
            exit;
        } else {
            // Jika eksekusi gagal, tampilkan alert dengan pesan error
            echo "<script>alert('Gagal menyimpan data pengguna: " . addslashes($stmt->error) . "');</script>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Regis - Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body class="bg-gradient-to-br from-red-500 via-orange-500 to-yellow-500 min-h-screen">
    <div class="min-h-screen flex items-center justify-center p-4">
        <div class="bg-white/90 backdrop-blur-sm p-8 rounded-2xl shadow-2xl w-full max-w-md transform transition-all hover:scale-105">
            <!-- Logo/Icon -->
            <div class="text-center mb-8">
                <div class="bg-gradient-to-r from-red-500 to-orange-500 w-20 h-20 rounded-full mx-auto flex items-center justify-center shadow-lg">
                    <i class="fas fa-user-circle text-4xl text-white"></i>
                </div>
                <h2 class="text-3xl font-bold mt-4 bg-gradient-to-r from-red-500 to-orange-500 bg-clip-text text-transparent">Register!</h2>
                <p class="text-gray-500 mt-2">Please Regis to continue</p>
            </div>

            <?php if (isset($error)): ?>
                <div class="mb-6 bg-red-100 border-l-4 border-red-500 p-4 rounded-md">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <i class="fas fa-exclamation-circle text-red-500"></i>
                        </div>
                        <div class="ml-3">
                            <p class="text-red-500 text-sm"><?= $error ?></p>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <form method="POST" class="space-y-6">
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-envelope text-gray-400"></i>
                    </div>
                    <input type="text" name="username" placeholder="Username minimal 4 karakter"
                        class="w-full pl-10 pr-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all bg-gray-50 focus:bg-white" id="username" name="username"
                        value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>"
                        required minlength="4"
                        required>
                </div>


                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-lock text-gray-400"></i>
                    </div>
                    <input type="password" name="password" placeholder="Password minimal 6 karakter"
                        class="w-full pl-10 pr-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all bg-gray-50 focus:bg-white"
                        required>
                </div>

                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-lock text-gray-400"></i>
                    </div>
                    <input type="password" class="w-full pl-10 pr-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all bg-gray-50 focus:bg-white"
                        id="confirm_password" name="confirm_password" placeholder="Confirm password" required>
                </div>

                <?php if (!empty($errors)): ?>
                    <ul class="mb-0">
                            <li class="text-red-400 text-center"><?php echo htmlspecialchars($errors[0]); ?></li>
                    </ul>
                <?php endif; ?>

                <button type="submit"
                    class="w-full bg-gradient-to-r from-red-500 to-orange-500 hover:from-red-600 hover:to-orange-600 text-white py-3 rounded-lg font-semibold transition-all duration-300 shadow-lg hover:shadow-xl flex items-center justify-center space-x-2">
                    <span>Sing Up</span>
                    <i class="fas fa-arrow-right"></i>
                </button>

                <div class="mt-6 text-center text-gray-600">
                    <p>back to login menu?
                        <a href="login.php" class="text-orange-500 hover:text-orange-600 font-semibold transition-colors">Sign in</a>
                    </p>
                </div>
            </form>
        </div>
    </div>

    <!-- Background decoration -->
    <div class="fixed top-0 left-0 w-full h-full pointer-events-none overflow-hidden -z-10">
        <div class="absolute top-1/4 left-1/4 w-64 h-64 bg-orange-300 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob"></div>
        <div class="absolute top-1/3 right-1/3 w-64 h-64 bg-yellow-300 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob animation-delay-2000"></div>
        <div class="absolute bottom-1/4 right-1/4 w-64 h-64 bg-yellow-300 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob animation-delay-4000"></div>
    </div>

</body>

</html>