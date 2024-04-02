<?php
session_start();
require_once('../db/DB_connection.php');
include '../layout/navbar.php';

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: ../index.php');
    exit;
}
// membatasi halaman sesuai user login
if ($_SESSION["role"] !== "kasir") {
    echo "<script>
            window.history.back(); 
          </script>";
    exit;
  }


$stmt = $conn->prepare("SELECT * FROM products");
$stmt->execute();
$result = $stmt->get_result();
$products = $result->fetch_all(MYSQLI_ASSOC);
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
                     <h4 class="card-title text-white">Transaction</h4>
                       
                        </div>
            <table class="table table-dark table-hover">
                <tr>
                    <th>ID</th>
                    <th>Nama Product</th>
                    <th>Harga Product</th>
                    <th>Pembaharuan Terakhir</th>
                    <th>Tindakan</th>
                </tr>
                <?php foreach ($products as $row): ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo htmlspecialchars($row['nama_produk']); ?></td>
                        <td>Rp. <?php echo number_format($row['harga_produk']); ?></td>
                        <td><?php echo date('d F Y H:i:s', strtotime($row['updated_at'])); ?></td>
                        <td class="action-buttons">
                        <a href="show_invoice.php?id=<?php echo $row['id']; ?>" class="btn btn-warning"><i class="bi bi-cart-plus"></i></a>
                        </td>
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
   
.container {
    margin-top: 50px;
    padding-top: 30px;

}
.action-buttons{
    margin: auto;
    display: flex;
    justify-content: center;
}

.modal-header {
    background-color: #303134;
}

.modal-title {
    color: #fff;
}

label {
    color: #fff;
}

.modal-body {
    background-color: #4C4C4C;
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

/* Style for action buttons */
.action-buttons {
    display: flex;
    gap: 5px;
    
}

.update-button,
.delete-button,
.checkout-button {
    padding: 8px 12px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

.update-button {
    background-color: #007bff;
    color: #fff;
}

.delete-button {
    background-color: #dc3545;
    color: #fff;
}

.checkout-button {
    background-color: #FF6B08;
    color: #fff;
}
</style>
