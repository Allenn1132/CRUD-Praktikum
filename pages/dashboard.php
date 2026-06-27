<?php
session_start();
include '../connection.php';

$total_produk = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM produk"))['total'] ?? 0;
$total_kategori = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(DISTINCT kategori) as total FROM produk"))['total'] ?? 0;
$total_stok = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(stok) as total FROM produk"))['total'] ?? 0;
$total_aset = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(stok * harga) as total FROM produk"))['total'] ?? 0;
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Sistem Inventaris Toko</title>
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
                    <a class="nav-link active" aria-current="page" href="dashboard.php">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Daftar Produk</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="kelola.php">Kelola Produk</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-5" style="max-width: 960px;">
    
    <div class="mb-5 text-center text-md-start">
        <h3 class="fw-bold m-0" style="letter-spacing: -0.03em;">Ringkasan Inventaris</h3>
        <p class="text-muted mt-1">Selamat datang di sistem manajemen stok toko Anda.</p>
    </div>

    <!-- Stat Cards Dashboard -->
    <div class="stat-card-container">
        <div class="stat-card">
            <span class="stat-card-title">Total Produk</span>
            <span class="stat-card-value"><?= number_format($total_produk, 0, ',', '.'); ?></span>
        </div>
        <div class="stat-card">
            <span class="stat-card-title">Kategori</span>
            <span class="stat-card-value"><?= number_format($total_kategori, 0, ',', '.'); ?></span>
        </div>
        <div class="stat-card">
            <span class="stat-card-title">Total Stok</span>
            <span class="stat-card-value"><?= number_format($total_stok, 0, ',', '.'); ?></span>
        </div>
        <div class="stat-card">
            <span class="stat-card-title">Total Aset</span>
            <span class="stat-card-value">Rp <?= number_format($total_aset, 0, ',', '.'); ?></span>
        </div>
    </div>

    <!-- Quick Navigation Card -->
    <div class="card-custom mt-4">
        <h5 class="fw-semibold mb-3">Akses Cepat</h5>
        <div class="d-flex flex-wrap gap-3">
            <a href="index.php" class="btn-ios-primary text-decoration-none py-2 px-4">Lihat Daftar Produk</a>
            <a href="kelola.php" class="btn-ios-secondary text-decoration-none py-2 px-4">Kelola Produk</a>
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
