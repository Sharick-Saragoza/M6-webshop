<?php
// Controleer of er al een sessie actief is
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/main.css">
    <title>JS-Crocs webshop</title>
</head>
<body>
    <!-- Container -->
    <div class="grid-container">
        <!-- Header / navbar -->
        <div class="grid-item header"> 
            <ul>
                <li style="float: left;"><a id="logo-navbar" href="index.php"><img id="logo-navbar" src="img/logo.svg" alt="logo"></a></li>
                <li><a href="cart.php">Cart</a></li>
                <!-- Dynamisch weergeven van Login of Logout -->
                <?php if (isset($_SESSION['email'])) { ?>
                    <li><a href="logout.php">Logout</a></li>
                <?php } else { ?>
                    <li><a href="login.php">Login</a></li>
                <?php } ?>
                <li><a href="index.php">Home</a></li>
              </ul>
        </div>
