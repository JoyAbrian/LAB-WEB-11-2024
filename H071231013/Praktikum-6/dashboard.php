<?php
session_start();

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$currentUser = $_SESSION['user'];

// Simulasi data user
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

// Fungsi untuk logout
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        /* Custom styles for the dashboard */
        body {
            background: linear-gradient(to right, #6a11cb, #2575fc);
        }
        .table-header {
            background-color: #4c1d95; /* Darker shade for header */
            color:#ffeb3b; /* Black text for better contrast on yellow */
        }
        .table-row {
            background-color: #ff0000; /* Red background for all rows */
        }
        .table-row:nth-child(even) {
            background-color: #ff0000; /* Red background for even rows as well */
        }
        .blue-text {
            color: #1a237e; /* Warna biru tua */
        }
    </style>
</head>
<body class="text-white min-h-screen p-8">
    <div class="max-w-4xl mx-auto">
        <header class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-bold mb-2 blue-text">Welcome, <?php echo htmlspecialchars($currentUser['name']); ?>!</h1>
                <p class="blue-text">Email: <?php echo htmlspecialchars($currentUser['email']); ?></p>
                <p class="blue-text">Username: <?php echo htmlspecialchars($currentUser['username']); ?></p>
            </div>
            <a href="?logout=1" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded">
                Logout
            </a>
        </header>

        <main>
            <h2 class="text-2xl font-semibold mb-4 blue-text">All Users</h2>
            <div class="bg-white rounded-lg shadow overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="table-header text-white">
                        <tr>
                            <th class="p-3">Name</th>
                            <th class="p-3">Email</th>
                            <th class="p-3">Username</th>
                            <th class="p-3">Gender</th>
                            <th class="p-3">Faculty</th>
                            <th class="p-3">Batch</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700">
                        <?php foreach ($users as $index => $user): ?>
                            <?php if ($user['username'] !== 'adminxxx'): ?>
                                <tr class="table-row blue-text">
                                    <td class="p-3"><?php echo htmlspecialchars($user['name']); ?></td>
                                    <td class="p-3"><?php echo htmlspecialchars($user['email']); ?></td>
                                    <td class="p-3"><?php echo htmlspecialchars($user['username']); ?></td>
                                    <td class="p-3"><?php echo isset($user['gender']) ? htmlspecialchars($user['gender']) : 'N/A'; ?></td>
                                    <td class="p-3"><?php echo isset($user['faculty']) ? htmlspecialchars($user['faculty']) : 'N/A'; ?></td>
                                    <td class="p-3"><?php echo isset($user['batch']) ? htmlspecialchars($user['batch']) : 'N/A'; ?></td>
                                </tr>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</body>
</html>
