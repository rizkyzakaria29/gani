<?php
session_start();
require_once('../db/DB_connection.php');
include '../layout/navbar.php';

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: ../index.php');
    exit;
}
// membatasi halaman sesuai user login
if ($_SESSION["role"] == "kasir") {
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
                     <h4 class="card-title text-white">Manage Product</h4>
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addProductModal">
                        <i class="bi bi-plus-lg"></i> Add Product
                        </button>
                        </div>
            <table class="table table-dark table-hover">
                <tr>
                    <th>ID</th>
                    <th>Product Name</th>
                    <th>Product Price</th>
                    <th>Last Updated</th>
                    <th>Actions</th>
                </tr>
                <?php foreach ($products as $row): ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo htmlspecialchars($row['nama_produk']); ?></td>
                        <td>Rp. <?php echo number_format($row['harga_produk']); ?></td>
                        <td><?php echo date('d F Y H:i:s', strtotime($row['updated_at'])); ?></td>
                        <td class="action-buttons">
                            <button class="update-button" data-toggle="modal" data-target="#upProductModal<?php echo $row['id']; ?>" data-product-id="<?php echo $row['id']; ?>"><i class="bi bi-pencil-square"></i></button>
                            <form action="../db/DB_delete_product.php" method="post">
                                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                <button type="submit" class="delete-button" name="delete_product" onclick="return confirm('Are you sure you want to delete this product?');"><i class="bi bi-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
</div>

<!-- Modal Tambah Product-->
<div class="modal fade" id="addProductModal" tabindex="-1" role="dialog" aria-labelledby="addProductModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addProductModalLabel">Add Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="../db/DB_add_product.php" method="post">  
                    <div class="form-group">
                        <label for="nama_produk">Product Name :</label>
                        <input type="text" name="nama_produk" id="nama_produk" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="harga_produk">Product Price :</label> 
                        <input type="number" name="harga_produk" class="form-control" required>
                    </div>
                    <button type="submit" name="add_product" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Update Product-->
<?php foreach ($products as $row): ?>
<div class="modal fade" id="upProductModal<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="upProductModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="upProductModalLabel">Update Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="../db/DB_update_product.php" method="post">  
                    <div class="form-group">
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                        <label for="nama_produk">Product Name :</label>
                        <input type="text" name="nama_produk" class="form-control" value="<?php echo $row['nama_produk']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="harga_produk">Product Price :</label> 
                        <input type="number" name="harga_produk" class="form-control" value="<?php echo $row['harga_produk']; ?>" required>
                    </div>
                    <button type="submit" name="update_product" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php endforeach; ?>

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
