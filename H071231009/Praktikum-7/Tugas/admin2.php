<?php
session_start();
include 'config/config.php';

$username = "adminxxx";
$password = "admin123";
$email = "admin@gmail.com";
$role = "admin";

$hashedPassword = password_hash($password, PASSWORD_BCRYPT);

$sql = "INSERT INTO users (username, password, email, role) VALUES ('$username', '$hashedPassword', '$email', '$role')";

if ($conn->query($sql) === TRUE) {
    echo "Pengguna berhasil ditambahkan!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
?>
