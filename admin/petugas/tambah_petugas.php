<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $judul = $_POST['judul'];
    $penulis = $_POST['penulis'];
    $penerbit = $_POST['penerbit'];
    $tahun_terbit = $_POST['tahun_terbit'];
    $sampul = $_POST['sampul'];

    $query = "INSERT INTO buku (judul, penulis, penerbit, tahun_terbit, sampul) 
              VALUES ('$judul', '$penulis', '$penerbit', '$tahun_terbit', '$sampul')";

    if (mysqli_query($conn, $query)) {
        header('Location: /perpus_ukk/admin/peminjam/index.php');
    } else {
        echo "Gagal menambahkan buku: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Petugas</title>
</head>
<body>
    <h1>Tambah Petugas Baru</h1>
    <form method="POST">
        Username: <input type="text" name="username" required><br>
        <br>
        Password: <input type="text" name="password"><br>
        <br>
        Email: <input type="text" name="email"><br>
        <br>
        Nama Lengkap: <input type="text" name="nama_lengkap"><br>
        <br>
        Alamat: <input type="text" name="alamat"><br>

        <input type="submit" value="Tambah Petugas">
    </form>
    <a href="/perpus_ukk/admin/petugas/index.php">Kembali ke Daftar Petugas</a>
</body>
</html>
