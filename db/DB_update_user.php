<?php 
session_start();
require_once('DB_connection.php');

if (isset($_POST['update_user'])) {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    $stmt = $conn->prepare("UPDATE users SET nama = ?, username = ?, password = ?, role = ? WHERE id = ?");
    $stmt->bind_param("ssssi", $nama, $username, $password, $role, $id);

    if ($stmt->execute()) {
        if ($stmt->affected_rows > 0) {
            echo "Update successfully!";
        } else {
            echo "No changes made to the user";
        }
    } else {
        echo "Failed to update user.";
    }

    $stmt->close(); // Close the statement here, inside the conditional block
}

header('location: ../pages/user.php');
exit;
?>
