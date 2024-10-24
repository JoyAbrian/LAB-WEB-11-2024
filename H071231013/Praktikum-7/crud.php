<?php
$_server_name = 'localhost';
$username = 'root';
$password = '';
$database = 'crud_mahasiswa';

$conn = new mysqli($_server_name, $username, $password, $database);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>