<?php
session_start();

$games = [
    1 => ['name' => 'Game 1', 'price' => 50],
    2 => ['name' => 'Game 2', 'price' => 40],
    3 => ['name' => 'Game 3', 'price' => 60],
];

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['game_id'])) {
    $gameId = $_POST['game_id'];
    $game = $games[$gameId];

    // Voeg game toe aan winkelwagen
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    // Controleer of de game al in de winkelwagen zit
    if (!array_key_exists($gameId, $_SESSION['cart'])) {
        $_SESSION['cart'][$gameId] = ['name' => $game['name'], 'price' => $game['price'], 'quantity' => 1];
    } else {
        // Verhoog de hoeveelheid als de game al in de winkelwagen zit
        $_SESSION['cart'][$gameId]['quantity']++;
    }
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Games</title>
</head>
<body>
    <h1>Games</h1>
    <ul>
        <?php foreach ($games as $id => $game): ?>
            <li>
                <?php echo htmlspecialchars($game['name']); ?> - 
                Prijs: &euro;<?php echo number_format($game['price'], 2); ?>
                <form method="post" style="display:inline;">
                    <input type="hidden" name="game_id" value="<?php echo $id; ?>">
                    <button type="submit">Voeg toe aan winkelwagen</button>
                </form>
            </li>
        <?php endforeach; ?>
    </ul>
    <a href="cart.php">Bekijk winkelwagen</a>
</body>
</html>
