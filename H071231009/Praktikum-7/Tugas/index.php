<?php 
    include 'config\config.php';

    $success ="";
    $error = "";

    if(isset($_GET['success'])) {
        $success = $_GET['success'];
    }

    if (isset($_GET['error'])) {
        $error = $_GET['error'];
    }

    $action = "";
    $id = "";
    $nama = "";
    $nim = "";
    $programStudi = "";

    // Tangani aksi edit jika ada parameter action=edit
    if (isset($_GET['action']) && $_GET['action'] == 'edit') {
        $id = $_GET['id'];
        $queryEdit = "SELECT * FROM mahasiswa WHERE id='$id'";
        $executeQEdit = mysqli_query($conn, $queryEdit);
        $data = mysqli_fetch_array($executeQEdit);
        if ($data) {
            $nim = $data['nim'];
            $nama = $data['nama'];
            $programStudi = $data['prodi'];
        }
    }

    // Tangani aksi submit (tambah atau edit data)
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nim = $_POST['nim'];
        $nama = $_POST['nama'];
        $programStudi = $_POST['programStudi'];

        if ($id) {
            // Edit Data
            // Periksa apakah NIM sudah ada
            $queryCheckNim = "SELECT * FROM mahasiswa WHERE nim = '$nim'";
            $executeCheckNim = mysqli_query($conn, $queryCheckNim);

            // Jika NIM sudah ada
            if (mysqli_num_rows($executeCheckNim) > 0) {
                // NIM sudah ada, tampilkan pesan kesalahan
                $error = "Gagal menambahkan data, NIM sudah ada.";
            } else {
                // Edit data
                $queryUpdate = "UPDATE mahasiswa SET nim='$nim', nama='$nama', prodi='$programStudi' WHERE id='$id'";
                $executeQUpdate = mysqli_query($conn, $queryUpdate);
                if ($executeQUpdate) {
                    header("Location: dashbord.php?success=Data berhasil diupdate");
                    exit();
                } else {
                    $error = "Gagal mengupdate data";
                }
            }
     
        } else {
            // Tambah Data
            // Periksa apakah NIM sudah ada
            $queryCheckNim = "SELECT * FROM mahasiswa WHERE nim = '$nim'";
            $executeCheckNim = mysqli_query($conn, $queryCheckNim);

            // Jika NIM sudah ada
            if (mysqli_num_rows($executeCheckNim) > 0) {
                // NIM sudah ada, tampilkan pesan kesalahan
                $error = "Gagal menambahkan data, NIM sudah ada.";
            } else {
                // Jika NIM belum ada, lakukan proses insert
                $queryInsert = "INSERT INTO mahasiswa (nim, nama, prodi) VALUES ('$nim', '$nama', '$programStudi')";
                $executeQInsert = mysqli_query($conn, $queryInsert);
                
                if ($executeQInsert) {
                    header("Location: dashbord.php?success=Data berhasil ditambahkan");
                    exit();
                } else {
                    $error = "Gagal menambahkan data";
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
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://unpkg.com/flowbite@1.6.3/dist/flowbite.min.css" />
    <link rel="stylesheet" href="style.css">
</head>
<body >
    <div class="w-full max-w-4xl mx-auto p-4">
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

        <div class="bg-white shadow-md rounded-lg p-6">
            <form method="POST">
                <div class="mb-4">
                    <label for="nama" class="block text-sm font-medium text-gray-700">NAMA</label>
                    <input type="text" name="nama" id="nama" value="<?= $nama ?>" class="mt-1 p-2 block w-full rounded-md border-gray-300 shadow-sm" required>
                </div>

                <div class="mb-4">
                    <label for="nim" class="block text-sm font-medium text-gray-700">NIM</label>
                    <input type="text" name="nim" id="nim" value="<?= $nim ?>" class="mt-1 p-2 block w-full rounded-md border-gray-300 shadow-sm" required>
                </div>


                <div class="mb-4">
                    <label for="programStudi" class="block text-sm font-medium text-gray-700">Program Studi</label>
                    <input type="text" name="programStudi" id="programStudi" value="<?= $programStudi ?>" class="mt-1 p-2 block w-full rounded-md border-gray-300 shadow-sm" required>
                </div>

    
                <a href="dashbord.php" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded inline-block">Kembali</a>
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">Simpan</button>

            </form>
        </div>
    </div>

</body>
</html>