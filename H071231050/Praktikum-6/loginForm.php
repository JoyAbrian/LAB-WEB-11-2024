<?php 
    session_start();
    $users = [
    [
        'email' => 'admin@gmail.com',
        'username' => 'adminxxx',
        'name' => 'Admin',
        'password' => password_hash('admin123', PASSWORD_DEFAULT),
    ],
    [
        'email' => 'nanda@gmail.com',
        'username' => 'nanda_aja',
        'name' => 'Wd. Ananda Lesmono',
        'password' => password_hash('nanda123', PASSWORD_DEFAULT),
        'gender' => 'Female',
        'faculty' => 'MIPA',
        'batch' => '2021',
    ],
    [
        'email' => 'arif@gmail.com',
        'username' => 'arif_nich',
        'name' => 'Muhammad Arief',
        'password' => password_hash('arief123', PASSWORD_DEFAULT),
        'gender' => 'Male',
        'faculty' => 'Hukum',
        'batch' => '2021',
    ],
    [
        'email' => 'eka@gmail.com',
        'username' => 'eka59',
        'name' => 'Eka Hanny',
        'password' => password_hash('eka123', PASSWORD_DEFAULT),
        'gender' => 'Female',
        'faculty' => 'Keperawatan',
        'batch' => '2021',
    ],
    [
        'email' => 'adnan@gmail.com',
        'username' => 'adnan72',
        'name' => 'Adnan',
        'password' => password_hash('adnan123', PASSWORD_DEFAULT),
        'gender' => 'Male',
        'faculty' => 'Teknik',
        'batch' => '2020',
    ]
    ];
    
    $_SESSION["users"] = $users;

    if (isset($_SESSION['user'])) {
        header("Location: homepage.php");
        exit();
    };
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <!-- <h1>Ervin Login Page</h1> -->
        <form action="loginForm.php" method="POST" class="formLogin">
            <h1>Login Form</h1>
            <div class="inputType">
                <label for="email">Email or Username</label>
                <input type="text" id="email" name="email" placeholder="Input Email or Username">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Input Password">
            </div>
            <button type="submit" class="button">Login</button>
            <a href="registerForm.php">Don't have an account? Register here</a>
        </form>
            
        <?php 
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            foreach($users as $user){
                if ($_POST["email"] == $user["email"] || $_POST["email"] == $user["username"] 
                && password_verify($password , $user["password"])) {
                    $_SESSION["user"] = $user;
                    header("Location: homepage.php");
                }else {
                    $alert = "Email Dan Password Tidak Terdaftar!!";
                }
            }
        }   
        ?>
    </div>
</body>
</html>