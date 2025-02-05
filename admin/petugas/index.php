<?php
include 'config.php'; // Pastikan config.php hanya di-include sekali

$query_user = mysqli_query($conn, "SELECT * FROM user"); // Menggunakan tabel user
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <title>Perpustakaan Digital</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2>Data Petugas</h2>
        <br>
        <a href="/perpus_ukk/admin/petugas/tambah_petugas.php" class="btn btn-primary">Tambah Petugas</a>
        <br><br>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Username</th>
                    <th>Password</th>
                    <th>Email</th>
                    <th>Nama Lengkap</th>
                    <th>Alamat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                while ($val_user = mysqli_fetch_assoc($query_user)) { // Gunakan $query_user, bukan $query_buku
                ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= htmlspecialchars($val_user['username']); ?></td>
                    <td><?= htmlspecialchars($val_user['password']); ?></td>
                    <td><?= htmlspecialchars($val_user['email']); ?></td>
                    <td><?= htmlspecialchars($val_user['nama_lengkap']); ?></td>
                    <td><?= htmlspecialchars($val_user['alamat']); ?></td>
                    <td>
                    <a href="edit_petugas.php?id=<?= $val_buku['id_buku']; ?>" class="btn btn-warning">Edit</a>
                    <a href="hapus_petugas.php?id=<?= $val_buku['id_buku']; ?>" class="btn btn-danger"
                    onclick="return confirm('Apakah Anda yakin ingin menghapus petugas ini?');">Hapus</a>

                    </td>
                </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
        <a href="/perpus_ukk/admin/dashboard.php">Kembali ke Halaman Dashboard</a>
    </div>
</body>

<!-- jQuery library -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
<!-- Popper JS -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<!-- Bootstrap JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</html>
