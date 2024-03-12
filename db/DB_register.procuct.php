<?php
require_once('DB_connection.php');

if($_SERVER ["REQUEST_METHOD"] == "POST"){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $nama = $_POST['nama'];

    $check_query = "SELECT * FROM users WHERE username = '$username' LIMIT 1";
    $check_query = mysqli_query($conn, $check_query);

    if ($check_query && mysqli_num_rows($check_query) > 0) {
        $error_message = "Username already exist. Please choose a different username.";
    } else {
        $insert_query = "INSERT INTO users (username,password,nama) VALUES ('$username','$password','$nama')";
        $insert_result = mysqli_query($conn,$insert_query);
        if ($insert_result){
            header("LOcation: ../index.php");
            exit();
        }else {
            $error_message = "Registration failed. Please try again later.";
        }
    }
}
?>