<!-- Include PHP header -->
<?php 
include "incl/header.php";

//regel 17, 19, 23, 25 en 27 zijn standaard
include "db/dbconnection.class.php";
//maak een nieuwe instantie aan van dbconnection
$dbconnect = new dbconnection();
//bouw een sql-statement waarmee je iets uit de database haalt
$sql = "SELECT * FROM producten ORDER BY RAND() LIMIT 1";
// //prepare is een method uit de PDO-class; het is een tussenstap waarmee je veiligheid inbouwt
 $query = $dbconnect->prepare($sql);
// //execute is ook een method uit de PDO-class, de daadwerkelijke bevraging van de database
 $query->execute();
// //fetchAll is een method uit de PDO: trekt alle gevraagde data uit de database en zet hem in de array $recset
 $recset = $query->fetchAll(2);
// //om de ruwe data van je database-bevraging te laten zien
echo "<pre>";
print_r($recset);
echo "</pre>";
?>

<!-- Sidenav -->
<div class="grid-item sidenav">
            <h1 style="padding-left: 23px;">Categories</h1> 
            <button class="dropdown-btn">Gents 
                <i class="fa fa-caret-down"></i>
            </button>
            <div class="dropdown-container">
                <a href="#">Link 1</a>
                <a href="#">Link 2</a>
                <a href="#">Link 3</a>
            </div>
            <button class="dropdown-btn">Ladies
                <i class="fa fa-caret-down"></i>
            </button>
            <div class="dropdown-container">
                <a href="#">Link 1</a>
                <a href="#">Link 2</a>
                <a href="#">Link 3</a>
            </div>
            <button class="dropdown-btn">Children
                <i class="fa fa-caret-down"></i>
            </button>
            <div class="dropdown-container">
                <a href="#">Link 1</a>
                <a href="#">Link 2</a>
                <a href="#">Link 3</a>
            </div>
            <button class="dropdown-btn">Accesories
                <i class="fa fa-caret-down"></i>
            </button>
            <div class="dropdown-container">
                <a href="#">Link 1</a>
                <a href="#">Link 2</a>
                <a href="#">Link 3</a>
            </div>
        </div>
        <!-- Main -->
        <div class="grid-item main">
            <div class="products-container">
                    <div class="product">
                        <img class="product-image" src="img/crocs.png" alt="Green Crocs" style="width:100%;">
                        <h1>Green Crocs</h1>
                        <p class="price">$49.99</p>
                        <p>Lorem jeamsun denim lorem jeansum. Skibidi green Crocs for the battlepass.</p>
                        <a href="product.php"><button>View product</button></a>
                      </div>
                      <div class="product">
                        <img class="product-image" src="img/crocs.png" alt="Green Crocs" style="width:100%;">
                        <h1>Green Crocs</h1>
                        <p class="price">$49.99</p>
                        <p>Lorem jeamsun denim lorem jeansum. Skibidi green Crocs for the battlepass.</p>
                        <a href="product.php"><button>View product</button></a>
                      </div>
                      <div class="product">
                        <img class="product-image" src="img/crocs.png" alt="Green Crocs" style="width:100%;">
                        <h1>Green Crocs</h1>
                        <p class="price">$49.99</p>
                        <p>Lorem jeamsun denim lorem jeansum. Skibidi green Crocs for the battlepass.</p>
                        <a href="product.php"><button>View product</button></a>
                      </div>
            </div>
        </div>

<!-- Include PHP footer -->
<?php 
include "incl/footer.php"
?>