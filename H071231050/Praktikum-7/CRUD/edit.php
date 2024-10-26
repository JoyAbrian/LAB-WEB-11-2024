<?php
include '../conn.php';
$id = $_GET['id'];

$query = "SELECT * FROM mahasiswa WHERE id = $id";
$user = $conn->query($query);

$result = $user->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Mahasiswa</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-br from-red-500 via-orange-500 to-yellow-500 min-h-screen">
    <nav class="bg-gray-700 shadow-lg">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <span class="text-2xl font-bold text-orange-600">
                        <i class="fas fa-graduation-cap mr-2"></i>
                        Edit data mahasiswa
                    </span>
                </div>
            </div>
        </div>
    </nav>
    <div class="max-w-xl mx-auto p-6 bg-gray-700 shadow-lg rounded-lg mt-10">
        <h2 class="text-2xl font-semibold text-white mb-4">Edit Data Mahasiswa</h2>
        <form action="editData.php" method="POST" class="space-y-4">
            <div>
                <label for="id" class="block text-white">ID</label>
                <input type="text" name="id" value="<?= $result['id'] ?>" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring focus:ring-blue-200 focus:outline-none" readonly>
            </div>
            <div>
                <label for="nama" class="block text-white">Nama</label>
                <input type="text" name="nama" value="<?= $result['nama'] ?>" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring focus:ring-blue-200 focus:outline-none" required>
            </div>
            <div>
                <label for="nim" class="block text-white">NIM</label>
                <input type="text" name="nim" value="<?= $result['nim'] ?>" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring focus:ring-blue-200 focus:outline-none" required>
            </div>
            <div>
                <label for="prodi" class="block text-white">Program Studi</label>
                <input type="text" name="prodi" value="<?= $result['prodi'] ?>" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring focus:ring-blue-200 focus:outline-none" required>
            </div>
            <button type="submit" class="bg-orange-500 text-white px-4 py-2 rounded-md hover:bg-orange-600">Simpan</button>
        </form>
    </div>
</body>

</html>