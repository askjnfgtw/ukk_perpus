<?php
include 'config.php';

$id = $_GET['id'];
$query = "DELETE FROM user WHERE id_user = $id";

if (mysqli_query($conn, $query)) {
    header('Location: /perpus_ukk/admin/petugas/index.php');
} else {
    echo "Gagal menghapus buku: " . mysqli_error($conn);
}
?>
