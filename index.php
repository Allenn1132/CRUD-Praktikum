<?php
session_start();
include 'connection.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Sistem Inventaris Toko</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<nav class="navbar navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand fw-bold" href="#">Sistem Inventaris Toko</a>
    </div>
</nav>

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Manajemen Data Produk</h3>

        <a href="tambah.php" class="btn btn-primary">
            + Tambah Produk
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">

            <table class="table table-bordered table-hover align-middle">
                <thead class="table-dark text-center">
                    <tr>
                        <th>Kode</th>
                        <th>Nama Produk</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th width="170">Aksi</th>
                    </tr>
                </thead>

                <tbody>

                <?php
                $query = mysqli_query($conn, "SELECT * FROM produk ORDER BY id_produk DESC");

                if(mysqli_num_rows($query) > 0){

                    while($data = mysqli_fetch_assoc($query)){
                ?>

                    <tr>
                        <td><?= htmlspecialchars($data['kode']); ?></td>

                        <td><?= htmlspecialchars($data['nama']); ?></td>

                        <td><?= htmlspecialchars($data['kategori']); ?></td>

                        <td>
                            Rp <?= number_format($data['harga'],0,',','.'); ?>
                        </td>

                        <td class="text-center">
                            <?= $data['stok']; ?>
                        </td>

                        <td class="text-center">

                            <a href="edit.php?id=<?= $data['id_produk']; ?>"
                               class="btn btn-warning btn-sm">
                                Edit
                            </a>

                            <form action="hapus.php" method="POST" class="d-inline">
                                <input type="hidden" name="id" value="<?= $data['id_produk']; ?>">

                                <button type="submit"
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('Yakin ingin menghapus produk ini?')">
                                    Hapus
                                </button>
                            </form>

                        </td>
                    </tr>

                <?php
                    }
                }else{
                ?>

                    <tr>
                        <td colspan="6" class="text-center">
                            Belum ada data produk.
                        </td>
                    </tr>

                <?php } ?>

                </tbody>

            </table>

        </div>
    </div>

</div>

</body>
</html>