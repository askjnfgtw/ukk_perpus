<?php
include 'config.php';

// Cek apakah id dikirim di URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("ID Buku tidak ditemukan! Pastikan Anda mengakses halaman ini dengan benar.");
}

// Hindari SQL Injection
$id = intval($_GET['id']); // Konversi ke angka untuk keamanan

// Cek apakah buku dengan ID tersebut ada di database
$check = mysqli_query($conn, "SELECT * FROM buku WHERE id_buku = $id");
if (mysqli_num_rows($check) == 0) {
    die("Buku dengan ID tersebut tidak ditemukan!");
}

// Hapus data
$query = "DELETE FROM buku WHERE id_buku = $id";
if (mysqli_query($conn, $query)) {
    header('Location: index.php?message=deleted');
    exit();
} else {
    echo "Gagal menghapus buku: " . mysqli_error($conn);
}
?>
