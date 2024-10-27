<?php 
    session_start();
    include 'config\config.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $username = $_POST['staticEmail'];
        $password = $_POST['inputPassword'];

        $sql = "SELECT * FROM users WHERE username='$username' OR email='$username'";
        $result = $conn->query($sql);

        if ($result -> num_rows > 0) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password'])) {
                $_SESSION['username'] = $user['username'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['role'] = $user['role'];

                header('Location: dashbord.php');
                exit;
            } else {
                echo "Password salah!";
            }
        } else {
        echo "Pengguna tidak ditemukan!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="row">
        <div class="kiri col-6" >

        </div>

        <div class="kanan col-6">
            <div class="form">
                <form action="" method="POST">
                    <h2 align=center>WELCOME BACK!</h1>
                    <h6 align=center>Login to your account</h4>
                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Username</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="staticEmail" name="staticEmail" placeholder="username or email" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" id="inputPassword" name="inputPassword" placeholder="password" required>
                        </div>
                    </div>
    
                    <p align=center>Doesn't have an account? <a href="daftar.php" class="daftar">SignUp</a></p>
    
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn3 w-100">Login</button>
                    </div>
                </form>
            </div>
        </div>
        

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>