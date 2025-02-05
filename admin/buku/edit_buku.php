<?php
include 'config.php';

// Pastikan ID tersedia di URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("ID Buku tidak ditemukan!");
}

$id = intval($_GET['id']); // Pastikan ID adalah angka

$result = mysqli_query($conn, "SELECT * FROM buku WHERE id_buku = $id");

if (!$result) {
    die("Query Error: " . mysqli_error($conn));
}

$buku = mysqli_fetch_assoc($result);

if (!$buku) {
    die("Buku tidak ditemukan!");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $judul = $_POST['judul'];
    $penulis = $_POST['penulis'];
    $penerbit = $_POST['penerbit'];
    $tahun_terbit = $_POST['tahun_terbit'];

    // Cek apakah ada file baru yang diupload
    if ($_FILES['sampul']['name']) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["sampul"]["name"]);
        move_uploaded_file($_FILES["sampul"]["tmp_name"], $target_file);
        $sampul = basename($_FILES["sampul"]["name"]);
    } else {
        $sampul = $buku['sampul']; // Jika tidak ada upload, gunakan gambar lama
    }

    $query = "UPDATE buku SET judul='$judul', penulis='$penulis', penerbit='$penerbit', 
              tahun_terbit='$tahun_terbit', sampul='$sampul' WHERE id_buku=$id";

    if (mysqli_query($conn, $query)) {
        header('Location: index.php');
    } else {
        echo "Gagal mengupdate buku: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Buku</title>
</head>
<body>
    <h1>Edit Buku</h1>
    <form method="POST" enctype="multipart/form-data">
        Judul: <input type="text" name="judul" value="<?= $buku['judul']; ?>" required><br>
        <br>
        Penulis: <input type="text" name="penulis" value="<?= $buku['penulis']; ?>"><br>
        <br>
        Penerbit: <input type="text" name="penerbit" value="<?= $buku['penerbit']; ?>"><br>
        <br>
        Tahun Terbit: <input type="number" name="tahun_terbit" value="<?= $buku['tahun_terbit']; ?>"><br>
        <br>
        Sampul: <input type="file" name="sampul"><br>
        <br>
        <img src="/uploads/<?= $buku['sampul']; ?>" width="100" alt="Sampul Buku"><br>
        <br>
        <input type="submit" value="Update Buku">
    </form>
    <a href="index.php">Kembali ke Daftar Buku</a>
</body>
</html>
