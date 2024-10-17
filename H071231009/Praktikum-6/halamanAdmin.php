<?php
session_start();
if (!isset($_SESSION['email']) || $_SESSION['role'] !== 'admin') {
    header('Location: halamanLogin.php');
    exit();
}
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
]
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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

        .welcome{
            background-color: rgba(99, 99, 255, 0.422);
            text-align:center;
            border-radius:20px;
            padding:8px;
            margin-bottom:20px;
            box-shadow: 0 10px 20px rgba(215, 194, 194, 0.836);
        }

        .welcome p{
            font-size:18px;
        }
        
        strong{
            color:pink;
        }

        table {
            background-color: rgba(99, 99, 255, 0.422);
            width: 80%;
            border-collapse: collapse;
            color: white;
        }

        th, td {
            border: 2px solid pink;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
            color: black;
        }

        .logout{
            margin-top:20px;
            padding:8px;
            background-color:red; 
            border-radius: 10px;
            background-color: rgba(99, 99, 255, 0.422);
            border: 4px solid rgba(79, 1, 58, 0.2);
        }

        .logout a{
            color: white;
            text-decoration:none;
        }

        .logout:hover {
            background: rgba(255, 192, 203, 0.658);
        }
    </style>
</head>
<body>
    <div class="welcome">
        <h1>Welcome, Admin!</h1>
        <p><strong>Email:</strong> <?= $_SESSION['email']; ?></p>
        <p><strong>Username:</strong> <?= $_SESSION['username']; ?></p>
        <button class="logout"><a href="logout.php">Logout</a></button>
    </div>

    <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Email</th>
                    <th scope="col">Username</th>
                    <th scope="col">Gender</th>
                    <th scope="col">Faculty</th>
                    <th scope="col">Batch</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1 ?>
                <?php foreach($users as $user): ?>
                    <?php 
                    if ($user['email'] === 'admin@gmail.com' || $user['username'] === 'adminxxx') {
                        continue;
                    }?>          
                <tr>
                    <th scope="row"><?= $i++ ?></th>
                    <td><?= $user['name'] ?></td>
                    <td><?= $user['email'] ?></td>
                    <td><?= $user['username'] ?></td>
                    <td><?= $user['gender'] ?></td>
                    <td><?= $user['faculty'] ?></td>
                    <td><?= $user['batch'] ?></td>
                </tr>
                <?php endforeach ?>
            </tbody>
    </table>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>