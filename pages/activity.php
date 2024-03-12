<?php
session_start();
require_once('../db/DB_connection.php');
include '../layout/navbar.php';

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: ../index.php');
    exit;
}
// membatasi halaman sesuai user login
if ($_SESSION["role"] == "kasir" || $_SESSION["role"] == "admin"  ) {
    echo "<script>
            window.history.back(); 
          </script>";
    exit;
  }
$stmt = $conn->prepare("SELECT * FROM log_activity");
$stmt->execute();
$result = $stmt->get_result();
$activity = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset=UTF-8>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../asset/style/manage_product.css">
</head>
<body>

<div class="container">
        <div class="card">
            <div class="card-body"> 
            <div class="card-header d-flex justify-content-between align-items-center">
                     <h4 class="card-title text-white">Log Activity</h4>  
                </div>
                <table class="table table-dark table-hover">
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Nama Produk</th>
                        <th>Harga Produk</th>
                        <th>Tanggal Transaksi</th>
                    </tr>
                    <?php foreach ($activity as $row): ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['username']; ?></td>
                            <td><?php echo $row['nama_produk']; ?></td>
                            <td>Rp. <?php echo number_format($row['harga_produk']); ?></td>
                            <td><?php echo $row['tanggal_transaksi']; ?></td>
                           
                        </tr>
                        <?php endforeach; ?>
                </table>
            </div>
        </div>
    </div>
  

</body>
</html>

<style>
       body {
    margin: 0;
    padding: 0;
    background-color: #303134;
}


/* Untuk membuat jarak antara navbar dan kontainer */
.container {
    margin-top: 50px;
    padding-top: 30px;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

table th,
table td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: center;
}

table th {
    background-color: #303134;
}
.card {
    background-color: #4C4C4C;
}


</style>