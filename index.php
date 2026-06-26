<?php
session_start();
include 'koneksi.php';

// Proteksi agar tidak bisa diakses tanpa login
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Sistem Inventaris Toko</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <nav class="navbar navbar-dark bg-dark mb-4">
        <div class="container">
            <span class="navbar-brand fw-bold">Sistem Inventaris Toko</span>
            <div class="d-flex text-white">
                <span class="me-3">Admin: <?= $_SESSION['username']; ?></span>
                <a href="logout.php" class="btn btn-outline-light btn-sm">Logout</a>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="fw-bold">Manajemen Data Produk</h4>
            <a href="tambah.php" class="btn btn-primary">+ Tambah Produk</a>
        </div>

        <div class="table-responsive bg-white p-3 rounded shadow-sm">
            <table class="table table-striped table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>Kode</th><th>Nama Produk</th><th>Kategori</th><th>Harga</th><th>Stok</th><th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = mysqli_query($koneksi, "SELECT * FROM produk ORDER BY id_produk DESC");
                    while ($data = mysqli_fetch_array($query)) {
                    ?>
                    <tr>
                        <td><?= $data['kode']; ?></td>
                        <td><?= htmlspecialchars($data['nama']); ?></td>
                        <td><?= $data['kategori']; ?></td>
                        <td>Rp <?= number_format($data['harga'], 0, ',', '.'); ?></td>
                        <td><?= $data['stok']; ?></td>
                        <td class="text-center">
                            <a href="edit.php?id=<?= $data['id_produk']; ?>" class="btn btn-sm btn-warning">Edit</a>
                            <form action="hapus.php" method="POST" style="display:inline;">
                                <input type="hidden" name="id" value="<?= $data['id_produk']; ?>">
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Hapus produk?');">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>