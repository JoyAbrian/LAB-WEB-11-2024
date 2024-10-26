<?php
include '../conn.php';

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $nim = $_POST['nim'];
    $prodi = $_POST['prodi'];
    $id = $_POST['id'];

    $query = $conn->prepare("UPDATE mahasiswa SET nama = ?, nim = ?, prodi = ? WHERE id = ?");
    $query->bind_param('sssi', $nama, $nim, $prodi, $id);

    if($query->execute()){
        header('Location: ../index.php');
    } else {
        echo 'Error: ' . $query->error;
    }
}