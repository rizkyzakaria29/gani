<?php
require_once('./db/DB_connection.php');
require_once('./db/DB_login.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rizzshop | Login</title>
    <link href='asset/images/logo.jpg' rel='shortcut icon'>
</head>
<body>
    <div class="container">
        <img style="width: 200px; margin-bottom: 2rem;" src="./asset/images/logo.jpg" alt="btr">
         <div class="text-center">
                 <p style="font-family: 'Lato', sans-serif;">Rizzshop Diamond Cashier</p>
            </div>
        <form  method="POST">
            <?php if (isset($error_message)) : ?>
                <div class="error-message"><?php echo $error_message; ?></div>
            <?php endif; ?>
            <div>
                <input id="username" name="username" type="text" placeholder="Username" required>
            </div>

            <div>
                <input id="password" name="password" type="password" placeholder="Password">
            </div>
            <div>
                <button type="submit">Log In</button>
            </div>
        </form>
    </div>
</body>
</html>
<style>
    body {
    font-family: 'Lato', sans-serif;;
    background-color: #FFC0CB;
    margin: 0;
    padding: 0;
    overflow: hidden;
}

.container {
    max-width: 400px;
    margin: 70px auto;
    padding: 20px;
    background-color: #8D1A22;
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
}

form label {
    display: block;
    font-weight: bold;
    color: #fff;
    
}

form input[type="text"],
form input[type="password"] {
    width: 95%;
    padding: 10px;
    font-size: 14px;
    border-radius: 4px;
    border: 0px solid #ccc;
    background-color: #4C4C4C;
    color: #fff;
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
    font-size: 14px;
    padding-top: 5px;
}

.text-center p {
    margin: 0;
    color: #fff;
}

.text-center p a {
    color: #007bff;
    text-decoration: none;
}

.text-center p a:hover {
    text-decoration: underline;
}

</style>