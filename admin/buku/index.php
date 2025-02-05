<?php
include 'config.php'; // Pastikan config.php hanya di-include sekali

$result = mysqli_query($conn, "SELECT * FROM buku");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <title>Perpustakaan Digital</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2>Data Buku</h2>
        <br>
        <a href="/perpus_ukk/admin/buku/tambah_buku.php" class="btn btn-primary">Tambah Buku</a>
        <br><br>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Id Buku</th>
                    <th>Judul Buku</th>
                    <th>Penulis</th>
                    <th>Penerbit</th>
                    <th>Tahun Terbit</th>
                    <th>Sampul Buku</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query_buku = mysqli_query($conn, "SELECT * FROM buku"); // Gunakan $conn, bukan $koneksi
                $no = 1;
                while ($val_buku = mysqli_fetch_assoc($query_buku)) { // Ubah foreach menjadi while agar lebih aman
                ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $val_buku['id_buku']; ?></td> <!-- Perbaikan: Tambahkan id_buku -->
                    <td><?= $val_buku['judul']; ?></td>
                    <td><?= $val_buku['penulis']; ?></td>
                    <td><?= $val_buku['penerbit']; ?></td>
                    <td><?= $val_buku['tahun_terbit']; ?></td>
                    <td>
                        <img src="/uploads/<?= $val_buku['sampul']; ?>" width="100" alt="Sampul Buku"> 
                    </td>
                    <td>
                    <a href="edit_buku.php?id=<?= $val_buku['id_buku']; ?>" class="btn btn-warning">Edit</a>
                    <a href="hapus_buku.php?id=<?= $val_buku['id_buku']; ?>" class="btn btn-danger"
                    onclick="return confirm('Apakah Anda yakin ingin menghapus buku ini?');">Hapus</a>

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
