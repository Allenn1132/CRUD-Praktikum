<?php
session_start();
include '../connection.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Inventaris Toko</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../style.css">
</head>

<body>

<nav class="navbar navbar-expand-lg navbar-custom py-3">
    <div class="container">
        <a class="navbar-brand" href="dashboard.php">Inventaris Toko</a>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="dashboard.php">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="index.php">Daftar Produk</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="kelola.php">Kelola Produk</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-4" style="max-width: 960px;">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-semibold m-0" style="letter-spacing: -0.02em;">Daftar Produk</h4>
    </div>

    <div class="card-custom">
        <div class="table-responsive">
            <table class="table table-custom">
                <thead>
                    <tr>
                        <th>Kode</th>
                        <th>Nama Produk</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th class="text-center">Stok</th>
                    </tr>
                </thead>

                <tbody>

                <?php
                $query = mysqli_query($conn, "SELECT * FROM produk ORDER BY id_produk DESC");

                if(mysqli_num_rows($query) > 0){
                    while($data = mysqli_fetch_assoc($query)){
                ?>

                    <tr>
                        <td class="fw-semibold"><?= htmlspecialchars($data['kode']); ?></td>
                        <td><?= htmlspecialchars($data['nama']); ?></td>
                        <td>
                            <span class="badge-custom badge-bg-neutral">
                                <?= htmlspecialchars($data['kategori']); ?>
                            </span>
                        </td>
                        <td>
                            Rp <?= number_format($data['harga'],0,',','.'); ?>
                        </td>
                        <td class="text-center fw-medium">
                            <?= $data['stok']; ?>
                        </td>
                    </tr>

                <?php
                    }
                }else{
                ?>
                    <tr>
                        <td colspan="5" class="text-center text-muted py-4">
                            Belum ada data produk.
                        </td>
                    </tr>
                <?php } ?>

                </tbody>
            </table>
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
