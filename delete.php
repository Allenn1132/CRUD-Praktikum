<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { background-color: #f8f9fa; font-family: Arial, sans-serif; }
        .wrapper { display: flex; min-height: 100vh; }
        .sidebar { width: 250px; background: #212529; padding: 20px; }
        .sidebar .logo { color: white; font-size: 1.4rem; font-weight: bold; margin-bottom: 30px; text-align: center; }
        .sidebar a { color: #ced4da; text-decoration: none; display: block; padding: 12px 16px; margin-bottom: 8px; border-radius: 10px; transition: 0.2s; }
        .sidebar a:hover { background-color: #343a40; color: white; }
        .sidebar a.active { background-color: #495057; color: white; font-weight: 600; }
        .content { flex: 1; padding: 30px; }
        .card { border: none; border-radius: 15px; }
    </style>
</head>
<body>
<div class="wrapper">
    <div class="sidebar">
        <div class="logo">CRUD Produk</div>
        <a href="index.php">Dashboard</a>
        <a href="create.php">Tambah Produk</a>
        <a href="update.php">Ubah Produk</a>
        <a href="delete.php" class="active">Hapus Produk</a>
    </div>
    <div class="content">
    <div class="card shadow-sm">
        <div class="card-body">
            <h2 class="mb-3">Hapus Produk</h2>
                <p class="text-muted">
                    Selamat datang di Sistem CRUD Produk.
                </p>
            </div>
        </div>
    </div>

    <?php
include 'connection.php';

if(isset($_POST['id'])){

    $id = $_POST['id'];

    $sql = "DELETE FROM produk WHERE id_produk='$id'";

    if($conn->query($sql) === TRUE){

        echo "<script>
            alert('Produk berhasil dihapus');
            window.location='index.php';
        </script>";

    }else{

        echo "Error : " . $conn->error;

    }

}else{

    echo "ID tidak terkirim";

}

$conn->close();
?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
