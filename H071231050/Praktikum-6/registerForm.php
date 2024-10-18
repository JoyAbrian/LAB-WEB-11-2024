<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Handling</title>
</head>

<body>
    <h1>Form Feedback</h1>
    <form action="form-handling.php" method="POST">
        <label for="nama">Nama</label><br>
        <input type="text" name="nama" id="nama"><br><br>

        <label for="email">Email</label><br>
        <input type="email" name="email" id="email"><br><br>

        <label for="pesan">Pesan</label><br>
        <textarea name="pesan" id="pesan"></textarea><br><br>

        <button type="submit">Kirim</button>
    </form>
    <br>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST["nama"]) && !empty($_POST["email"]) && !empty($_POST["pesan"])) {
        $nama = $_POST["nama"];
        $email = $_POST["email"];
        $pesan = $_POST["pesan"];
    ?>

        <table border="1">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Pesan</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?= $nama; ?></td>
                    <td><?= $email; ?></td>
                    <td><?= $pesan; ?></td>
                </tr>
            </tbody>
        </table>
    <?php
    }
    ?>
</body>

</html>