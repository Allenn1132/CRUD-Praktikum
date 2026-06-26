<?php
session_start();
include 'connection.php';

// Cek apakah tombol simpan ditekan
if (isset($_POST['simpan'])) {
    $kode = $_POST['kode'];
    $nama = $_POST['nama'];
    $kategori = $_POST['kategori'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];

    // Menggunakan Prepared Statement untuk mencegah SQL Injection
    $stmt = $conn->prepare("INSERT INTO produk (kode, nama, kategori, harga, stok) VALUES (?, ?, ?, ?, ?)");
    
    // "sssii" berarti: string, string, string, integer, integer
    $stmt->bind_param("sssii", $kode, $nama, $kategori, $harga, $stok);
    
    if ($stmt->execute()) {
        header("Location: index.php");
        exit;
    } else {
        $error = "Gagal menyimpan data ke database!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Produk - Sistem Inventaris Toko</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand fw-bold" href="index.php">Sistem Inventaris Toko</a>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Daftar Produk</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="create.php">Tambah Produk</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Laporan Stok</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white pb-0 pt-4 border-0 ms-3">
                    <h4 class="fw-bold">Input Produk Baru</h4>
                </div>
                <div class="card-body p-4">
                    
                    <?php if(isset($error)): ?>
                        <div class="alert alert-danger"><?= $error; ?></div>
                    <?php endif; ?>

                    <form method="POST" action="">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Kode Produk</label>
                            <input type="text" name="kode" class="form-control" placeholder="Contoh: PRD-001" required>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Nama Produk</label>
                            <input type="text" name="nama" class="form-control" placeholder="Masukkan nama produk..." required>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Kategori</label>
                            <input type="text" name="kategori" class="form-control" placeholder="Contoh: Sembako, Minuman, Pakaian" required>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Harga Satuan (Rp)</label>
                                <input type="number" name="harga" class="form-control" placeholder="0" required>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Jumlah Stok</label>
                                <input type="number" name="stok" class="form-control" placeholder="0" required>
                            </div>
                        </div>

                        <hr class="mt-4 mb-4 text-muted">
                        
                        <div class="d-flex justify-content-end gap-2">
                            <a href="index.php" class="btn btn-secondary">Batal</a>
                            <button type="submit" name="simpan" class="btn btn-primary px-4">Simpan Data</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>