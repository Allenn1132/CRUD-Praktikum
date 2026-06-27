<?php
session_start();
include '../connection.php';

$id = $_GET['id'] ?? null;

if (!$id) {
    header("Location: ../pages/kelola.php");
    exit;
}

$stmt = $conn->prepare("SELECT * FROM produk WHERE id_produk = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$produk = $result->fetch_assoc();

if (!$produk) {
    header("Location: ../pages/kelola.php");
    exit;
}

if (isset($_POST['simpan'])) {
    $kode     = $_POST['kode'];
    $nama     = $_POST['nama'];
    $kategori = $_POST['kategori'];
    $harga    = $_POST['harga'];
    $stok     = $_POST['stok'];

    $stmt = $conn->prepare("UPDATE produk SET kode = ?, nama = ?, kategori = ?, harga = ?, stok = ? WHERE id_produk = ?");
    $stmt->bind_param("sssiii", $kode, $nama, $kategori, $harga, $stok, $id);

    if ($stmt->execute()) {
        header("Location: ../pages/kelola.php");
        exit;
    } else {
        $error = "Gagal memperbarui data!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Produk - Sistem Inventaris Toko</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../style.css">
</head>

<body>

<nav class="navbar navbar-expand-lg navbar-custom py-3">
    <div class="container">
        <a class="navbar-brand" href="../pages/dashboard.php">Inventaris Toko</a>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="../pages/dashboard.php">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../pages/index.php">Daftar Produk</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="../pages/kelola.php">Kelola Produk</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-5" style="max-width: 680px;">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card-custom">
                <h4 class="card-title-custom m-0 mb-4">Edit Produk</h4>

                <?php if (isset($error)): ?>
                    <div class="alert alert-danger py-2 px-3 mb-3 border-0 rounded-3 text-danger bg-danger bg-opacity-10" style="font-size: 0.9rem;"><?= $error; ?></div>
                <?php endif; ?>

                <form method="POST" action="">
                    <div class="mb-3">
                        <label class="form-label-custom">KODE PRODUK</label>
                        <input type="text" name="kode" class="form-control-custom w-100"
                               value="<?= htmlspecialchars($produk['kode']) ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label-custom">NAMA PRODUK</label>
                        <input type="text" name="nama" class="form-control-custom w-100"
                               value="<?= htmlspecialchars($produk['nama']) ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label-custom">KATEGORI</label>
                        <input type="text" name="kategori" class="form-control-custom w-100"
                               value="<?= htmlspecialchars($produk['kategori']) ?>" required>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label-custom">HARGA SATUAN (Rp)</label>
                            <input type="number" name="harga" class="form-control-custom w-100"
                                   value="<?= htmlspecialchars($produk['harga']) ?>" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label-custom">JUMLAH STOK</label>
                            <input type="number" name="stok" class="form-control-custom w-100"
                                   value="<?= htmlspecialchars($produk['stok']) ?>" required>
                        </div>
                    </div>

                    <hr class="my-4" style="border-color: rgba(0,0,0,0.08);">

                    <div class="d-flex justify-content-end gap-2">
                        <a href="../pages/kelola.php" class="btn-ios-secondary text-decoration-none py-2 px-4">Batal</a>
                        <button type="submit" name="simpan" class="btn-ios-primary py-2 px-4">Update Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
