<?php

session_start();
require_once('DB_connection.php');

// membatasi halaman sebelum login
// if (!isset($_SESSION["login"])) {
//   echo "<script>
//           alert('Anda perlu login untuk memasuki halaman');
//           document.location.href = '../index.php';
//         </script>";
//   exit;
// }

if (isset($_POST['delete_user']) && isset($_POST['id'])) {
  $id = $_POST['id'];

  $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
  $stmt->bind_param("i", $id);
  $stmt->execute();

  if ($stmt->affected_rows > 0) {
      echo "user deleted succesfully";
  } else {
      echo "failed to delete user";
  }

  $stmt->close();
  $conn->close();

  header ('Location: ../pages/user.php');
}