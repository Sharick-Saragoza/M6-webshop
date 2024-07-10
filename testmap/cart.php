<?php
session_start();
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Winkelwagen</title>
</head>
<body>
    <h1>Winkelwagen</h1>
    <?php if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])): ?>
        <ul>
            <?php foreach ($_SESSION['cart'] as $gameId => $game): ?>
                <li>
                    <?php echo htmlspecialchars($game['name']); ?> - 
                    Prijs: &euro;<?php echo number_format($game['price'], 2); ?> - 
                    Hoeveelheid: <?php echo $game['quantity']; ?> - 
                    Subtotaal: &euro;<?php echo number_format($game['price'] * $game['quantity'], 2); ?>
                    <form method="post" action="remove.php" style="display:inline;">
                        <input type="hidden" name="game_id" value="<?php echo $gameId; ?>">
                        <button type="submit">Verwijder</button>
                    </form>
                </li>
            <?php endforeach; ?>
        </ul>
        <p><a href="games.php">Verder winkelen</a></p>
    <?php else: ?>
        <p>Je winkelwagen is leeg. <a href="games.php">Ga verder met winkelen</a></p>
    <?php endif; ?>
</body>
</html>
