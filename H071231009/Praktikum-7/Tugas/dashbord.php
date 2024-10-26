<?php
include "./config/config.php";
session_start(); 

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}

$success = "";
$error = "";

// Ambil data role dan informasi user dari session
$role = $_SESSION['role'] ?? 'mahasiswa'; 
$username = $_SESSION['username'] ?? 'Guest';
$email = $_SESSION['email'] ?? 'Not Available';

// Ambil kata kunci pencarian jika ada
$search = isset($_GET['search']) ? $_GET['search'] : '';

// Ambil halaman saat ini dari URL, jika tidak ada default ke halaman 1
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = 5; // Batasi jumlah data per halaman
$offset = ($page - 1) * $limit; // Hitung offset untuk query

// Hitung total baris data untuk menghitung jumlah halaman
$queryTotalRows = "SELECT COUNT(*) as total FROM mahasiswa WHERE nama LIKE '%$search%' OR nim LIKE '%$search%'";
$resultTotalRows = mysqli_query($conn, $queryTotalRows);
$row = mysqli_fetch_assoc($resultTotalRows);
$totalRows = $row['total'];

// Hitung total halaman
$totalPages = ceil($totalRows / $limit);

// Query untuk mengambil data mahasiswa dengan pagination dan pencarian
$queryGetAll = "SELECT * FROM mahasiswa WHERE nama LIKE '%$search%' OR nim LIKE '%$search%' ORDER BY id ASC LIMIT $limit OFFSET $offset";
$executeQGetAll = mysqli_query($conn, $queryGetAll);

// Tangani aksi delete jika admin
if ($role == 'admin' && isset($_GET['action']) && $_GET['action'] == 'delete') {
    $id = $_GET['id'];
    $queryDelete = "DELETE FROM mahasiswa WHERE id='$id'";
    $executeQDelete = mysqli_query($conn, $queryDelete);
    if ($executeQDelete) {
        header("Location: dashbord.php?success=Data berhasil dihapus");
        exit();
    } else {
        header("Location: dashbord.php?error=Gagal menghapus data");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://unpkg.com/flowbite@1.6.3/dist/flowbite.min.css" />
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="w-full max-w-4xl mx-auto p-4">
        <!-- Form pencarian -->
        <form method="get" action="dashbord.php" class="mb-4">
            <input type="text" name="search" placeholder="Cari Nama atau NIM" value="<?= htmlspecialchars($search) ?>" class="border px-4 py-2 rounded w-full md:w-1/2">
            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded ml-2">Cari</button>
        </form>

        <!-- Pesan error dan sukses -->
        <?php if ($error) { ?>
            <div class="bg-red-100 text-red-800 p-3 rounded mb-4">
                <?php echo $error ?>
            </div>
        <?php } ?>

        <?php if ($success) { ?>
            <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
                <?php echo $success ?>
            </div>
        <?php } ?>

        <div class="p-6 min-h-screen flex flex-col justify-between">
            <div class="flex justify-between items-center">
                <h1 class="text-xl font-bold text-white">Data Mahasiswa</h1>
                
                <div>
                    <!-- Tombol tambah hanya muncul jika admin -->
                    <?php if ($role == 'admin') { ?>
                        <a href="index.php" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded inline-block">Tambah Data</a>
                    <?php } ?>
    
                    <!-- Tombol untuk membuka modal profil -->
                    <button id="openModal" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">Lihat Profil</button>
                </div>
            </div>

            <!-- Modal Pop-up Profil -->
            <div id="profileModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
                <div class="bg-white p-6 rounded shadow-lg max-w-sm w-full">
                    <h2 class="text-xl font-bold mb-4 text-center">Profil Pengguna</h2>
                    <p><strong>Username:</strong> <?php echo $username; ?></p>
                    <p><strong>Email:</strong> <?php echo $email; ?></p>
                    <p><strong>Role:</strong> <?php echo $role; ?></p>
                    <a href="logout.php" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded inline-block">Logout</a>
                    <button id="closeModal" class="mt-4 bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">Tutup</button>
                </div>
            </div>

            <!-- Tabel Data Mahasiswa -->
            <div class="mt-4 border border-gray-300">
                <table class="w-full table-auto border-collapse border border-gray-300">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="border px-4 py-2 text-start">No</th>
                            <th class="border px-4 py-2 text-start">NAMA</th>
                            <th class="border px-4 py-2 text-start">NIM</th>
                            <th class="border px-4 py-2 text-start">Program Studi</th>
                            <!-- Kolom Aksi hanya muncul jika admin -->
                            <?php if ($role == 'admin') { ?>
                                <th class="border px-4 py-2 text-start">Aksi</th>
                            <?php } ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $number = $offset + 1; // Untuk penomoran data pada setiap halaman
                        while ($data = mysqli_fetch_array($executeQGetAll)) {
                            $id = $data['id'];
                        ?>
                            <tr class="odd:bg-white even:bg-gray-100">
                                <td class="border px-4 py-2"><?= $number++ ?></td>
                                <td class="border px-4 py-2"><?= $data['nama'] ?></td>
                                <td class="border px-4 py-2"><?= $data['nim'] ?></td>
                                <td class="border px-4 py-2"><?= $data['prodi'] ?></td>
                                <!-- Tombol edit dan hapus hanya muncul jika admin -->
                                <?php if ($role == 'admin') { ?>
                                    <td class="border px-4 py-2">
                                        <a href="index.php?action=edit&id=<?php echo $id ?>"
                                           class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded">Edit</a> |
                                        <a href="dashbord.php?action=delete&id=<?php echo $id ?>"
                                           class="bg-red-700 hover:bg-red-800 text-white px-3 py-1 rounded"
                                           onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
                                    </td>
                                <?php } ?>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>

            <!-- Pagination Links -->
            <div class="mt-4 flex justify-center">
                <?php if ($page > 1) { ?>
                    <a href="?page=<?= $page - 1 ?>&search=<?= $search ?>" class="px-3 py-1 bg-gray-300 hover:bg-gray-400 rounded">Sebelumnya</a>
                <?php } ?>

                <?php for ($i = 1; $i <= $totalPages; $i++) { ?>
                    <a href="?page=<?= $i ?>&search=<?= $search ?>" class="px-3 py-1 <?= ($i == $page) ? 'bg-blue-500 text-white' : 'bg-gray-300' ?> hover:bg-gray-400 rounded"><?= $i ?></a>
                <?php } ?>

                <?php if ($page < $totalPages) { ?>
                    <a href="?page=<?= $page + 1 ?>&search=<?= $search ?>" class="px-3 py-1 bg-gray-300 hover:bg-gray-400 rounded">Berikutnya</a>
                <?php } ?>
            </div>
        </div>
    </div>

    <!-- Script for handling modal behavior -->
    <script>
        const modal = document.getElementById('profileModal');
        const openModalBtn = document.getElementById('openModal');
        const closeModalBtn = document.getElementById('closeModal');

        openModalBtn.addEventListener('click', function() {
            modal.classList.remove('hidden');
        });

        closeModalBtn.addEventListener('click', function() {
            modal.classList.add('hidden');
        });

        window.addEventListener('click', function(event) {
            if (event.target === modal) {
                modal.classList.add('hidden');
            }
        });
    </script>

    <script src="https://unpkg.com/flowbite@1.6.3/dist/flowbite.min.js"></script>
</body>
</html>
