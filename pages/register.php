<?php
require_once('../db/DB_connection.php');
require_once('../db/DB_register.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset= "UTF-8">
    <meta name="viewport" content="width-device-width, initial-scale-1.0">
    <title>Shopiria | Register</title>
    <link rel="stylesheet" href="../assets/style/register.css">
</head>
<body>
    <div class="container">
        <img style="width: 200px; margin-bottom: 2rem; " src="../asset/images/logo.jpeg" alt="Logo">
        <form method="POST">
            <?php if (isset($error_message)) : ?>
                <div class="error-message"><?php echo $error_message; ?></div>
                <?php endif; ?>
                <div>
                    <label for="username">Username</label>
                    <input id= "username" name="username" type="text" placeholder= "Username" required>
                </div>
                <div> <label for="password">password</label>
                <input id="password" name="password" type="password" placeholder="****"
required>
</div>
<div>
    <label for="nama">Nama</label>
<input id= "nama" name= "nama" type="text" placeholder= "Your Full Name" required>
</div>
<div>
    <button type= "submit">Register</button>
</div>
<p>Have an account? <a href="../index.php">Login</a></p> </form>
</div>
</body>
</html>
<style>
    body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
}

.container {
    max-width: 400px;
    margin: 100px auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.container img {
    display: block;
    margin: 0 auto;
}

form {
    margin-top: 20px;
}

form div {
    margin-bottom: 20px;
    display: flex;
    flex-direction: column;
}

form label {
    font-weight: bold;
    margin-bottom: 5px;
}

form input[type="text"],
form input[type="password"] {
    width: 100%;
    padding: 10px;
    font-size: 16px;
    border-radius: 4px;
    border: 1px solid #ccc;
    box-sizing: border-box; /* Prevents padding from increasing width */
}


form button {
    width: 100%;
    padding: 10px;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
}

form button:hover {
    background-color: #0056b3;
}

.error-message {
    color: red;
    margin-bottom: 10px;
}

.text-center {
    text-align: center;
}

.text-center p {
    margin: 0;
}

.text-center p a {
    color: #007bff;
    text-decoration: none;
}

.text-center p a:hover {
    text-decoration: underline;
}

</style>