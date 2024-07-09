<!-- Include PHP login header -->
<?php 
// Als de product id niet bestaat of als de product id geen cijfer is dan doet ie niks
if(! isset($_GET['product_id']) || intval($_GET['product_id']) <= 0) {
    header('Location: index.php');
    exit();
}

include 'db/dbconnection.class.php';

// Veiligheid dingetje met placeholders en spul
// Get the product ID and ensure it's an integer
$product_id = intval($_GET['product_id']);

// Define the SQL query with a named placeholder
$sql = 'SELECT * FROM producten WHERE id = :product_id';


try {
    // Create a new database connection
    $dbconnect = new dbconnection();

    // Prepare the SQL statement
    $query = $dbconnect->prepare($sql);

    // Execute the statement with the placeholder values
    $query->execute([':product_id' => $product_id]);

    // Fetch the results as an associative array
    $product = $query->fetchAll(PDO::FETCH_ASSOC);

    // Handle the fetched product data as needed
    // For example, you can print it out or process it further

} catch (PDOException $e) {
    // Handle any errors during the database interaction
    echo 'Database error: ' . $e->getMessage();
}

include "incl/header.php";
?>

<!-- Style through PHP -->
<style>
<?php include 'styles/product.css'; ?>
</style>

<!-- Main -->
<div class="grid-item main">
    <div class="product-container">
        <div class="product-assets">
        <?php foreach($product as $record): ?>
            <img class="product-image" src='<?= $record['img']?>' alt="Green Crocs" style="width:100%;">
        <?php endforeach; ?>
        </div>
        <?php foreach($product as $record): ?>
        <div class="product-data" style="padding-left: 5%;">
            <h1><?= $record['name'] ?></h1>
            <p class="price"><?= $record['price']?> </p>
            <p><?= $record['color']?></p>
            <p><?= $record['size']?></p>
            <p><?= $record['category_id']?></p>
            <p><?= $record['availability']?></p>
            <p><?= $record['notes']?></p>
            <p><?= $record['description']?></p>

            <!-- Add to Cart Form -->
            <form action="cart.php" method="POST">
                <input type="hidden" name="product_id" value="<?= $product_id ?>">
                <button type="submit">Put in cart</button>
            </form>
        </div>
        <?php endforeach; ?>
    </div>
</div>
</body>
</html>
