<?php
session_start();
if (!isset($_SESSION['username'])) { // Check username instead of email
    header('Location: halamanLogin.php');
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <style>
        body{
            display: flex;
            flex-direction: column;          
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-image: url(bg2.jpeg);
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
            color: white;
        }
        .user{
            background-color: rgba(99, 99, 255, 0.422);
            text-align:left;
            border-radius:20px;
            width:400px;
            padding:20px;
            margin-bottom:20px;
            box-shadow: 0 10px 20px rgba(215, 194, 194, 0.836);
        }

        .user h1{
            text-align:center;
        }

        strong{
            color:pink;
        }

        button{
            padding:8px;
            background-color:red; 
            border-radius: 10px;
            background-color: rgba(99, 99, 255, 0.422);
            border: 4px solid rgba(79, 1, 58, 0.2);
            color:white;
        }

        button a{
            color: white;
            text-decoration:none;
        }

        button:hover {
            background: rgba(255, 192, 203, 0.658);
        }
    </style>
</head>
<body>
    <div class="user">
        <h1>Welcome, <?= $_SESSION['name']; ?>!</h1>
        <p><strong>Email:</strong> <?= $_SESSION['email']; ?></p>
        <p><strong>Username:</strong> <?= $_SESSION['username']; ?></p>
        <p><strong>Gender:</strong> <?= $_SESSION['gender']; ?></p>
        <p><strong>Faculty:</strong> <?= $_SESSION['faculty']; ?></p>
        <p><strong>Batch:</strong> <?= $_SESSION['batch']; ?></p>

        <button class="logout"><a href="logout.php">Logout</a></button>
    </div>

</body>
</html>