<?php
include 'config.php';

$id = $_GET['id'];
$result = mysqli_query($conn, "SELECT * FROM user WHERE id_user = $id");
$buku = mysqli_fetch_assoc($result);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $pass = $_POST['password'];
    $email = $_POST['email'];
    $nama_lengkap = $_POST['nama_lengkap'];
    $alamat = $_POST['alamat'];

    $query = "UPDATE user SET username='$username', pass='$password', email='$email', 
              nama_lengkap='$nama-lengkap', alamat='$alamat' WHERE id_user=$id";

    if (mysqli_query($conn, $query)) {
        header('Location: /perpus_ukk/admin/petugas/index.php');
    } else {
        echo "Gagal mengupdate peminjam: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Petugas</title>
</head>
<body>
    <h1>Edit Petugas</h1>
    <form method="POST">
        Username: <input type="text" name="username" value="<?= $user['username']; ?>" required><br>
        <br>
        Password: <input type="text" name="pass" value="<?= $user['password']; ?>"><br>
        <br>
        Email: <input type="text" name="email" value="<?= $user['email']; ?>"><br>
        <br>
        Nama Lengkap: <input type="text" name="nama_lengkap" value="<?= $user['nama_lengkap']; ?>"><br>
        <br>
        Alamat: <input type="text" name="alamat" value="<?= $user['alamat']; ?>"><br>
        <input type="submit" value="Update Buku">
    </form>
    <a href="/perpus_ukk/admin/petugas/index.php">Kembali ke Daftar Petugas</a>
</body>
</html>
