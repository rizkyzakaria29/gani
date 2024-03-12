<?php 
session_start();
require_once('../db/DB_connection.php');

// Ambil ID produk dari parameter URL jika tersedia
$product_id = isset($_GET['id']) ? $_GET['id'] : null;

// Jika ID produk tidak ada, arahkan kembali ke halaman transaksi.php
if (!$product_id) {
    header('Location: transaksi.php');
    exit;
}


// Mendapatkan ID produk dari parameter URL
$id_produk = $_GET['id'];

// Query untuk mendapatkan informasi produk berdasarkan ID
$stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
$stmt->bind_param("i", $id_produk);
$stmt->execute();
$result = $stmt->get_result();
$produk = $result->fetch_assoc();

// Jika produk tidak ditemukan, arahkan pengguna kembali ke halaman sebelumnya
if (!$produk) {
    header('Location: transaksi.php');
    exit;
}

// Simpan informasi aktivitas log ke database
$username = $_SESSION['username']; // Ganti dengan cara Anda mengambil username dari sesi
$nama_produk = $produk['nama_produk'];
$harga_produk = $produk['harga_produk'];
$tanggal_transaksi = date('Y-m-d H:i:s');

// Query untuk menyimpan aktivitas log ke dalam database
$stmt_log = $conn->prepare("INSERT INTO log_activity (username, nama_produk, harga_produk, tanggal_transaksi) VALUES (?, ?, ?, ?)");
$stmt_log->bind_param("ssds", $username, $nama_produk, $harga_produk, $tanggal_transaksi);
$stmt_log->execute();

// Query untuk mendapatkan informasi produk berdasarkan ID
$stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
$stmt->bind_param("i", $product_id);
$stmt->execute();
$result = $stmt->get_result();

// Jika produk dengan ID yang diberikan tidak ditemukan, arahkan kembali ke halaman transaksi.php
if ($result->num_rows === 0) {
    header('Location: transaksi.php');
    exit;
}

// Ambil data produk
$product = $result->fetch_assoc();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            padding: 20px;
            max-width: 400px;
            margin: 0 auto;
        }

        .struk {
            border: 1px solid #000;
            padding: 20px;
            margin-bottom: 20px;
        }

        .logo {
            max-width: 100px;
            margin-bottom: 20px;
        }

        .text-center {
            text-align: center;
        }

        /* Sembunyikan tombol cetak saat halaman dicetak */
        @media print {
            .no-print {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="text-center">
            <img src="../asset/images/logo.jpg" alt="Logo" class="logo">
            <h2>Rizzshop</h2>
        </div>
        <div class="struk">
            <center><h4>Struk Pembayaran</h4></center>
            <p><strong>Product Name:</strong> <?php echo $product['nama_produk']; ?></p>
            <p><strong>Product Price:</strong> Rp. <?php echo number_format($product['harga_produk'], 0, ',', '.'); ?></p>
        </div>
        <div class="text-center">
            <button class="btn btn-primary no-print" onclick="window.print()">Print</button>
            <a href="transaksi.php" class="btn btn-secondary no-print">Back</a>
        </div>
    </div>
</body>
</html>
