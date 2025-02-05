<?php
// Koneksi ke database
$host = 'localhost'; // Nama host, misalnya localhost
$username = 'root';  // Username MySQL
$password = '';      // Password MySQL (kosong jika belum diset)
$dbname = 'ukk_perpus_digital'; // Nama database

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Proses registrasi
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_user = $_POST['id_user'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
   
    $email = $_POST['email'];
    $nama_lengkap = $_POST['nama_lengkap'];
    $alamat = $_POST['alamat'];

    // Cek apakah email sudah terdaftar
    $checkEmail = $conn->prepare("SELECT * FROM user WHERE email = ?");
    $checkEmail->bind_param('s', $email);
    $checkEmail->execute();
    $result = $checkEmail->get_result();

    if ($result->num_rows > 0) {
        echo "Email sudah terdaftar!";
    } else {
      // Menyimpan data pengguna baru
$stmt = $conn->prepare("INSERT INTO user (id_user, username, password, Email, nama_lengkap, alamat) 
VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param('ssssss', $id_user, $username, $password, $email, $nama_lengkap, $alamat);

// Jika insert data berhasil
if ($stmt->execute()) {
// Redirect ke halaman berhasil
header("Location: berhasil.html"); // Ganti dengan lokasi halaman berhasil
exit;
} else {
echo "Terjadi kesalahan. Silakan coba lagi.";
}

        



        $stmt->close();
    }

    $checkEmail->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi - Perpustakaan Digital</title>
    <link rel="stylesheet" href="registrasi.css">
</head>
<body>

<div class="container">
    <h2>Registrasi Pengguna</h2>
    <form method="POST" action="">
        <label for="id_user">Id User</label>
        <input type="text" id="id_user" name="id_user" required>

        <label for="username">Username</label>
        <input type="text" id="username" name="username" required>

        <label for="password">Password</label>
        <input type="password" id="password" name="password" required>

        <label for="email">Email</label>
        <input type="email" id="email" name="email" required>

        <label for="nama_lengkap">Nama Lengkap</label>
        <input type="text" id="nama_lengkap" name="nama_lengkap" required>

        <label for="alamat">Alamat</label>
        <input type="text" id="alamat" name="alamat" required>
        

        <input type="submit" value="Daftar">
    </form>
    <p>Sudah punya akun? <a href="signin.php">Login di sini</a></p>
</div>

</body>
</html>
