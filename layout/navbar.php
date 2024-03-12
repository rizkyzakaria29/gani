<?php
require_once('../db/DB_connection.php');

// Anda dapat menyesuaikan kondisi ini dengan URL halaman Anda
$dashboard_active = (basename($_SERVER['PHP_SELF']) == 'dashboard.php') ? 'active' : '';
$transaksi = (basename($_SERVER['PHP_SELF']) == 'transaksi.php') ? 'active' : '';
$manage_product_active = (basename($_SERVER['PHP_SELF']) == 'manage_product.php') ? 'active' : '';
$user_active = (basename($_SERVER['PHP_SELF']) == 'user.php') ? 'active' : '';
$activity_active = (basename($_SERVER['PHP_SELF']) == 'activity.php') ? 'active' : '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href='../asset/images/logo.jpg' rel='shortcut icon'>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#">Rizzshop</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav">

      <li class="nav-item <?php echo $dashboard_active; ?>">
        <a class="nav-link" href="../pages/dashboard.php">Dashboard <span class="sr-only">(current)</span></a>
      </li>

      <?php if ($_SESSION['role'] == "kasir") : ?>
      <li class="nav-item <?php echo $transaksi; ?>">
        <a class="nav-link" href="../pages/transaksi.php">Transaction</a>
      </li>
      <?php endif; ?>

      <?php if ($_SESSION['role'] !== "kasir") : ?>
      <li class="nav-item <?php echo $manage_product_active; ?>">
        <a class="nav-link" href="../pages/manage_product.php">Manage Product</a>
      </li>
      <?php endif; ?>

      <?php if ($_SESSION['role'] !== "kasir") : ?>
      <li class="nav-item <?php echo $user_active; ?>">
        <a class="nav-link" href="../pages/user.php">User</a>
      </li>
      <?php endif; ?>

      <?php if ($_SESSION['role'] == "owner") : ?>
      <li class="nav-item <?php echo $activity_active; ?>">
        <a class="nav-link" href="../pages/activity.php">Activity</a>
      </li>
      <?php endif; ?>

    </ul>
  </div>
</nav>

<!-- Your page content goes here -->

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>
</html>
