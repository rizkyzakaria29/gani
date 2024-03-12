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
  
$stmt = $conn->prepare("SELECT * FROM users");
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_all(MYSQLI_ASSOC);
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
                     <h4 class="card-title text-white">User list</h4>
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addUserModal">
                        <i class="bi bi-plus-lg"></i>  Add User
                        </button>
            </div>
            
                <table class="table table-dark table-hover">
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                        <th>Role</th>
                        <th>Action</th>
                    </tr>
                    <?php foreach ($user as $row): ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['nama']; ?></td>
                            <td><?php echo date('d F Y H:i:s', strtotime ($row['created_at'])); ?></td>
                            <td><?php echo date('d F Y H:i:s', strtotime ($row['updated_at'])); ?></td>
                            <td><?php echo $row['role']; ?></td>
                            <td class="action-buttons">
                            <button class="btn btn-primary" data-toggle="modal" data-target="#upUserModal<?php echo $row['id']; ?>" data-user-id="<?php echo $row['id']; ?>"><i class="bi bi-pencil-square"></i></button>
                            <form action="../db/DB_delete_user.php" method="post">
                                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                <button type="submit" class="btn btn-danger" name="delete_user" onclick="return confirm('Are you sure you want to delete this user?');"><i class="bi bi-trash"></i></button>

                            </form>
                        </td>
                        </tr>
                        <?php endforeach; ?>
                </table>
            </div>
        </div>
    </div>
    
<!-- Modal Tambah User-->
<div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="addUserModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addUserModalLabel">Add User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="../db/DB_add_user.php" method="post">  
                    <div class="form-group">
                        <label for="nama">Nama Lengkap :</label>
                        <input type="text" name="nama" id="nama" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="username">Username :</label>
                        <input type="text" name="username" id="username" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password :</label> 
                        <input type="text" name="password" class="form-control" required>
                    </div>
                    <div class="form-group">
                  <label for="role">Role :</label>
                  <select name="role" id="role" class="form-control" required>
                      <option value="">-- Pilih Role --</option>
                      <option value="owner">Owner</option>
                      <option value="admin">Admin</option>
                      <option value="kasir">Kasir</option>
                  </select>
              </div>
                    <button type="submit" name="add_user" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Modal Update User-->
<?php foreach ($user as $row): ?>
<div class="modal fade" id="upUserModal<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="upUserModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="upUserModalLabel">Update User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="../db/DB_update_user.php" method="post">  
                    <div class="form-group">
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                        <label for="nama">Nama Lengkap :</label>
                        <input type="text" name="nama" id="nama" class="form-control" value="<?= $row['nama']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="username">Username :</label>
                        <input type="text" name="username" id="username" class="form-control" value="<?= $row['username']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password :</label> 
                        <input type="text" name="password" class="form-control" value="<?= $row['password']; ?>" required>
                    </div>
                    <div class="form-group">
                  <label for="role">Role :</label>
                  <select name="role" id="role" class="form-control" required>
                      <option value="">-- Pilih Role --</option>
                      <option value="owner">Owner</option>
                      <option value="admin">Admin</option>
                      <option value="kasir">Kasir</option>
                  </select>
                  </div>
                    <button type="submit" name="update_user" class="btn btn-primary">Submit</button>
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

/* Style for action buttons */
.action-buttons {
    display: flex;
    gap: 5px;
    justify-content: center;
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
    background-color: #28a745;
    color: #fff;
}

</style>