<?php
session_start();

// Simulasi data user dengan password yang di-hash
$users = [
    [
       'email' => 'admin@gmail.com',
       'username' => 'adminxxx',
       'name' => 'Admin',
       'password' => password_hash('admin123', PASSWORD_DEFAULT),
       'role' => 'admin',
   ],
   [
       'email' => 'nanda@gmail.com',
       'username' => 'nanda_aja',
       'name' => 'Wd. Ananda Lesmono',
       'password' => password_hash('nanda123', PASSWORD_DEFAULT),
       'gender' => 'Female',
       'faculty' => 'MIPA',
       'batch' => '2021',
       'role' => 'user', 
   ],
   [
       'email' => 'arif@gmail.com',
       'username' => 'arif_nich',
       'name' => 'Muhammad Arief',
       'password' => password_hash('arief123', PASSWORD_DEFAULT),
       'gender' => 'Male',
       'faculty' => 'Hukum',
       'batch' => '2021',
       'role' => 'user', 
   ],
   [
       'email' => 'eka@gmail.com',
       'username' => 'eka59',
       'name' => 'Eka Hanny',
       'password' => password_hash('eka123', PASSWORD_DEFAULT),
       'gender' => 'Female',
       'faculty' => 'Keperawatan',
       'batch' => '2021',
       'role' => 'user', 
   ],
   [
       'email' => 'adnan@gmail.com',
       'username' => 'adnan72',
       'name' => 'Adnan',
       'password' => password_hash('adnan123', PASSWORD_DEFAULT),
       'gender' => 'Male',
       'faculty' => 'Teknik',
       'batch' => '2020',
       'role' => 'user', 
   ]
   ];


$username = $_POST['username'] ?? '';  
$password = $_POST['password'] ?? '';


$userFound = null; 
foreach ($users as $user) {
    if ($user['username'] === $username || $user['email'] === $username) {
        $userFound = $user;
        break;
    }
}

if ($userFound && password_verify($password, $userFound['password'])) {
    $_SESSION['name'] = $userFound['name'];
    $_SESSION['email'] = $userFound['email'];
    $_SESSION['username'] = $userFound['username'];
    $_SESSION['role'] = $userFound['role'];  
    $_SESSION['gender'] = $userFound['gender'] ?? null; 
    $_SESSION['faculty'] = $userFound['faculty'] ?? null; 
    $_SESSION['batch'] = $userFound['batch'] ?? null; 

    if ($userFound['role'] === 'admin') {
        header('Location: halamanAdmin.php');
    } else {
        header('Location: halamanUser.php');
    }
    exit();
}

echo "<script>
        alert('Login gagal. Silakan coba lagi.');
        window.location.href = 'halamanLogin.php'; // Ganti dengan nama file halaman login Anda
      </script>";
?>