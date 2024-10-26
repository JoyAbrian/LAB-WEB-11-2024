<?php
include '../conn.php';

$id = $_GET['id'];

$query = $conn->prepare('DELETE FROM mahasiswa WHERE id = ?');
$query->bind_param('i', $id);

if($query->execute()){
    header('Location: ../index.php');
} else {
    echo 'Error: ' . $query->error;
}