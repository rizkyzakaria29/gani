<?php 
session_start();
require_once('../db/DB_connection.php');
include '../layout/navbar.php';

if (!isset($_SESSION['loggedin']) || $_SESSION[ 'loggedin'] !== true) {
    header('Location: ../index.php');
    exit;
}

$realName = $_SESSION['nama'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rizzshop | Welcome Cashier!</title>
</head>
<body>    
    <div class="dashboard-content">
        <h2>Hello, <?php echo htmlspecialchars($realName); ?>!</h2>
        <p>Welcome to the Rizzshop cashier dashboard. You can manage products and perform other tasks here.</p>
        <form action="../db/DB_logout.php" method="post">
        <button type="submit" class="btn-logout">Log Out</button>
    </form>
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

h1 {
    text-align: center;
    margin-top: 50px;
    color: #fff;
}

.dashboard-content {
    max-width: 800px;
    margin: 20px auto;
    margin-top: 150px;
    padding: 20px;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

h2 {
    margin-top: 20px;
}

.btn-logout {
    background-color: #dc3545;
    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    margin-top: 20px;
}

.btn-logout:hover {
    background-color: #c82333;
}

.text-blue-500 {
    color: #3b82f6;
}

.text-blue-500:hover {
    text-decoration: underline;
}

</style>