<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hapus Produk - Sistem Inventaris Toko</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../style.css">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-custom py-3">
    <div class="container">
        <a class="navbar-brand" href="../dashboard.php">Inventaris Toko</a>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="../dashboard.php">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../index.php">Daftar Produk</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="../kelola.php">Kelola Produk</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-5" style="max-width: 680px;">
    <div class="card-custom">
        <h4 class="card-title-custom m-0 mb-3">Hapus Produk</h4>
        <p class="text-muted m-0">Memproses permintaan penghapusan produk...</p>
    </div>
</div>

<?php
include '../connection.php';

if(isset($_POST['id'])){

    $id = $_POST['id'];

    $sql = "DELETE FROM produk WHERE id_produk='$id'";

    if($conn->query($sql) === TRUE){

        echo "<script>
            alert('Produk berhasil dihapus');
            window.location='../kelola.php';
        </script>";

    }else{

        echo "Error : " . $conn->error;

    }

}else{

    echo "ID tidak terkirim";

}

$conn->close();
?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
