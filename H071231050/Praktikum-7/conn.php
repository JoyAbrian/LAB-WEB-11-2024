<?php
// Tentukan Kredential DB
$server_name = 'localhost';
$username = 'root';
$password = '';
$database = 'db_praktikum7';

// Koneksikan DB
$conn = new mysqli($server_name, $username, $password, $database);

// Cek Keberhasilan Koneksi
if($conn->connect_error) {
    die("Koneksi Gagal: ". $conn->$connection_error);
}

