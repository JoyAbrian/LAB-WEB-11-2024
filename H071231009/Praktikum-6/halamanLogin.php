<?php
session_start();
if (isset($_SESSION['username'])) {
    if ($_SESSION['role'] === 'admin') {
        header('Location: halamanAdmin.php');
    } else {
        header('Location: halamanUser.php');
    }
    exit();
}

$_SESSION
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Login</title>
    <link rel="stylesheet" href="styles2.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <div class="kotak-form">
        <form action="proses.php" method="POST"> 
            <h1>Login</h1>
            <div class="input-box">
                <input type="text" id="username" name="username" class="input" required>
                <label for="username" class="label"> Username/Email</label>
                <i class='bx bxs-user icon'></i>
            </div>

            <div class="input-box">
                <input type="password" id="password" name="password" class="input" required>
                <label for="password" class="label"> Password</label>
                <i class='bx bxs-lock-alt icon'></i>
            </div>

            <div class="register">
                <p>Don't have an account? <a href="#">Register</a></p>
            </div>

            <div class="btn1">
                <button type="submit" class="btn">SUBMIT</button>
            </div>
            
        </form>
    </div>
</body>
</html>