<?php 
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: loginForm.php");
    exit();
}
if (!isset($_SESSION['users'])) {
    header("Location: loginForm.php");
    exit();
}
$user = $_SESSION['user'];
$users = $_SESSION['users'];

if($user["email"] == "admin@gmail.com")
{
    $dsAdmin = "block";
    $dsUser = "none";
}
else{
    $dsAdmin = "none";
    $dsUser = "block";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style1.css">
</head>
<body>
    <div class="containerAdmin" style="display : <?= $dsAdmin?>">
        <div class="admin">
            <h1>Welcome, <?php echo $user["name"]?></h1>
            <table class="nameUser">
                <tr>
                    <td>Email</td>
                    <td>: <?php echo $user["email"]?></td>
                </tr>
                <tr>
                    <td>Username </td>
                    <td>: <?php echo $user["username"]?></td>
                </tr>
            </table>
            <button><a href="logout.php">Logout</a></button>
        </div>
        <div class="informationUser">
            <div>
                <h1>All User</h1>
                <table border="1" class="tableInformation">
                    <thead>
                        <tr style="background-color : #ddeff5; color:black; font-weight:bold;">
                            <td>Name</td>
                            <td>Email</td>
                            <td>Username</td>
                            <td>Gender</td>
                            <td>Faculty</td>
                            <td>Batch</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $i = 0;
                            foreach($users as $use) :
                                if($use['email'] == "admin@gmail.com"){
                                    
                                }else{
                                    if($i % 2 == 0){
                                        $bg = "#ddeff5";
                                    }else {
                                        $bg = "white";
                                        
                                    }
                        ?>
                        <tr style="background-color : <?= $bg ?>; color:black">
                            <td><?php echo $use["name"]?> </td>
                            <td><?php echo $use["email"]?> </td>
                            <td><?php echo $use["username"]?> </td>
                            <td><?php echo $use["gender"]?> </td>
                            <td><?php echo $use["faculty"]?> </td>
                            <td><?php echo $use["batch"]?> </td>
                        </tr>
                        <?php }$i++; endforeach?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="containerUser" style="display : <?= $dsUser?>">
    <div class="user">
            <h1>Welcome, <?php echo $user["name"]?></h1>
            <table class="nameUser">
                <tr>
                    <td>Email</td>
                    <td>: <?php echo $user["email"]?></td>
                </tr>
                <tr>
                    <td>Username </td>
                    <td>: <?php echo $user["username"]?></td>
                </tr>
                <tr>
                    <td>Gender </td>
                    <td>: <?php echo $user["gender"]?></td>
                </tr>
                <tr>
                    <td>Faculty </td>
                    <td>: <?php echo $user["faculty"]?></td>
                </tr>
                <tr>
                    <td>Batch </td>
                    <td>: <?php echo $user["batch"]?></td>
                </tr>
            </table>
            <button><a href="logout.php">Logout</a></button>
        </div>
    </div>
</body>
</html>