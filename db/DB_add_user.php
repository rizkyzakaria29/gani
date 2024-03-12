<?php
session_start();
require_once('DB_connection.php');

if (isset($_POST['add_user'])) {
    $nama       = strip_tags($_POST['nama']);
    $username   = strip_tags($_POST['username']);
    $password   = strip_tags($_POST['password']);
    $role      = strip_tags($_POST['role']);

    // Generating a random string using openssl_random_pseudo_bytes (alternative to random_bytes)
    $kode_unik = bin2hex(openssl_random_pseudo_bytes(5));

    $stmt = $conn->prepare("INSERT INTO users (nama, username, password, role) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $nama, $username, $password, $role);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "User added successfully!";
    } else {
        echo "Failed to add user. Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();

    header('Location: ../pages/user.php');
    exit;
}
?>
