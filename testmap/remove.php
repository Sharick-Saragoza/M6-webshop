<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['game_id'])) {
    $gameId = $_POST['game_id'];

    if (isset($_SESSION['cart'][$gameId])) {
        unset($_SESSION['cart'][$gameId]);
    }
}

header('Location: cart.php');
exit();
