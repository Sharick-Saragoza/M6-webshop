
<?php

@include_once(__DIR__ . '/helpers/Auth.php');
@include_once(__DIR__ . '/helpers/Message.php');
@include_once(__DIR__ . '/database/Database.php');

if (guest()) {
   if (!headers_sent()) {
      //setMessage('login-messages', 'De winkelwagen is alleen te zien indien u bent ingelogd. Log a.u.b. in...');
      //header('Location: ./login.php');
      exit();
   } else {
      die('Pagina kan niet getoond worden als u niet bent ingelogd');
   }
}

Database::query("SELECT 
      `cart_items`.`id`, 
      `cart_items`.`cart_id`, 
      `cart_items`.`product_id`, 
      `cart_items`.`amount`,
      `cart`.`customer_id`,
      `producten`.`category_id`,
      `producten`.`name`,
      `producten`.`description`,
      `producten`.`price`,
      `producten`.`img`,
     (`cart_items`.`amount` * `products`.`price`) AS `product_total`
   FROM `cart_items`
   LEFT JOIN `products` ON `products`.`id` = `cart_items`.`product_id`
   LEFT JOIN `cart` ON `cart`.`id` = `cart_items`.`cart_id`
   WHERE `cart`.`customer_id` = :customer_id AND `cart`.`ordered` = 0", [":customer_id" => user_id()]);

$cart_items = Database::getAll();
$cart_total_amount = 0;
$cart_total_cost = 0.0;
$shipping_cost = 0.0;


foreach ($cart_items as $cart_item) {
   $cart_total_amount += intval($cart_item->amount);
   $cart_total_cost += floatval($cart_item->product_total);
}
$order_total = $cart_total_cost + $shipping_cost;

?>

<!DOCTYPE html>
<html lang="nl">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">

   <title>Webshop De Witte Kip</title>

   <link rel="apple-touch-icon" sizes="180x180" href="img/apple-touch-icon.png">
   <link rel="icon" type="image/png" sizes="32x32" href="img/favicon-32x32.png">
   <link rel="icon" type="image/png" sizes="16x16" href="img/favicon-16x16.png">
   <link rel="manifest" href="img/site.webmanifest">

   <link rel="stylesheet" href="styles/uikit.min.css">
   <link rel="stylesheet" href="styles/stylejohan.css">

</head>

<body>
   <nav class="uk-navbar-container">
      <div class="uk-container">
         <div uk-navbar>

            <div class="uk-navbar-left">
               <ul class="uk-navbar-nav">
                  <li>
                     <a href="/">
                        <img class="logo" src="img/logo4.png" alt="Webshop Het Witte Kippetje" title="Webshop Het Witte Kippetje" />
                        Het Witte Kippetje
                     </a>
                  </li>
               </ul>
            </div>

            <div class="uk-navbar-right">

               <ul class="uk-navbar-nav">
                  <li class="uk-active"><a href="/"><span uk-icon="icon: home"></span>Home</a></li>
                  <?php if (guest()) : ?>
                     <li><a href="login.php"><span uk-icon="icon: sign-in"></span>Inloggen</a></li>
                     <li><a href="register.php"><span uk-icon="icon: file-edit"></span>Registreren</a></li>
                  <?php endif; ?>
                  <?php if (isLoggedIn()) : ?>
                     <li>
                        <a href="cart.php">
                           <span uk-icon="icon: cart"></span>
                           Winkelwagen
                           <span id="cart_amount_indicator" class="uk-badge"><?= countItemsInCart() ?></span>
                        </a>
                     </li>
                     <li>
                        <a href="#"><span uk-icon="icon: user"></span>Welkom <?= user()->firstname ?> <span uk-navbar-parent-icon></span></a>
                        <div class="uk-navbar-dropdown">
                           <ul class="uk-nav uk-navbar-dropdown-nav">
                              <li class="uk-nav-header">Uw gegevens</li>
                              <li><a href="#"><span uk-icon="icon: settings"></span>Profiel</a></li>
                              <li><a href="#"><span uk-icon="icon: bag"></span>Bestellingen</a></li>
                              <li><a href="#"><span uk-icon="icon: credit-card"></span>Facturen</a></li>
                              <li><a href="#"><span uk-icon="icon: refresh"></span>Retouren</a></li>
                              <li><a href="#"><span uk-icon="icon: heart"></span>Wensenlijst</a></li>
                              <li class="uk-nav-header">Contact</li>
                              <li><a href="#"><span uk-icon="icon: info"></span>Klantenservice</a></li>
                              <li class="uk-nav-divider"></li>
                              <li>
                                 <form method="POST" action="logout.php" id="logout-form" style="display: none;">
                                    <input type="hidden" name="user_id" value="<?= user_id() ?>" />
                                 </form>
                                 <a href="javascript:void" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <span uk-icon="icon: sign-out"></span>Uitloggen
                                 </a>
                              </li>
                           </ul>
                        </div>
                     </li>
                  <?php endif; ?>
               </ul>

            </div>
         </div>
      </div>
   </nav>

   <main class="uk-container uk-padding">

<div class="uk-grid">
   <section class="uk-width-2-3 uk-flex uk-flex-column uk-cart-gap">
      <?php if ($cart_total_amount > 0) : ?>
         <?php foreach ($cart_items as $cart_item) : ?>
            <!-- BEGIN: SHOPPINGCART PRODUCT 1 -->
            <div class="uk-card-default uk-card-small uk-flex uk-flex-between">
               <div class="uk-card-media-left uk-widht-1-5">
                  <img src="<?= $cart_item->image ?>" alt="Witte kip" class="product-image uk-align-center">
               </div>
               <div class="uk-card-body uk-width-4-5 uk-flex uk-flex-between">
                  <div class="uk-width-3-4 uk-flex uk-flex-column">
                     <h2><?= $cart_item->name ?></h2>
                     <p class="uk-margin-remove-top">
                        <?= substr($cart_item->description, 0, 120) . '...' ?>
                     </p>
                     <div class="uk-flex uk-flex-between">
                        <p class="uk-text-primary uk-text-bold">Prijs per stuk: &euro; <?= sprintf("%.2f", $cart_item->price) ?></p>
                        <p class="uk-text-primary uk-text-bold uk-margin-remove-top">Totaal: &euro; <?= sprintf("%.2f", $cart_item->product_total) ?></p>
                     </div>
                  </div>
                  <div class="uk-width-1-4 uk-flex uk-flex-between uk-flex-middle uk-flex-center">
                     <div class="uk-width-3-4 uk-flex uk-flex-column uk-flex-middle">
                        <form id="new-amount-form-<?= $cart_item->product_id ?>" method="POST" action="src/Formhandlers/change_amount.php" style="display: none">
                           <input type="hidden" value="<?= $cart_item->cart_id ?>" name="cart_id" />
                           <input type="hidden" value="<?= $cart_item->product_id ?>" name="product_id" />
                           <input type="hidden" id="new-amount-<?= $cart_item->product_id ?>" name="amount" />
                        </form>
                        <input id="amount-<?= $cart_item->product_id ?>" class="uk-form-controls uk-form-width-xsmall uk-text-medium" name="amount" value="<?= $cart_item->amount ?>" type="number" onchange="changeAmount(<?= $cart_item->product_id ?>)" />
                     </div>
                     <div class="uk-width-1-4">
                        <a href="#" class="uk-link-cart-trash uk-flex uk-flex-column uk-flex-middle uk-text-danger uk-flex-1">
                           <form id="delete-product-<?= $cart_item->product_id ?>" method="POST" action="src/Formhandlers/delete_product.php" style="display: none;">
                              <input type="hidden" value="<?= $cart_item->cart_id ?>" name="cart_id" />
                              <input type="hidden" name="product_id" value="<?= $cart_item->product_id ?>" />
                           </form>
                           <span uk-icon="icon: trash" onclick="deleteProduct(<?= $cart_item->product_id ?>)"></span>
                           <span class="uk-text-xsmall" onclick="deleteProduct(<?= $cart_item->product_id ?>)">Verwijder</span>
                        </a>
                     </div>
                  </div>
               </div>
            </div>
            <!-- EINDE: SHOPPINGCART PRODUCT 1 -->
         <?php endforeach; ?>
      <?php else : ?>
         <div class="uk-card-default uk-card-small uk-flex uk-flex-between">
            <div class="uk-card-body uk-width-4-5 uk-flex uk-flex-between">
               <h3>Nog geen artikelen in de winkelwagen.</h3>
            </div>
         </div>
      <?php endif; ?>
   </section>
   <section class="uk-width-1-3">
      <div class="uk-card uk-card-default uk-card-small">
         <div class="uk-card-header uk-align-center">
            <h2>Overzicht</h2>
         </div>
         <div class="uk-card-body">
            <div class="uk-flex uk-flex-between uk-flex-middle">
               <p class="uk-width-1-2">Artikelen (<?= $cart_total_amount ?>)</p>
               <p class="uk-width-1-2 uk-margin-remove-top uk-text-right">
                  &euro; <?= sprintf("%.2f", $cart_total_cost) ?>
               </p>
            </div>
            <div class="uk-flex uk-flex-between uk-flex-middle">
               <p class="uk-width-1-2">Verzendkosten</p>
               <p class="uk-width-1-2 uk-margin-remove-top uk-text-right">
                  &euro; <?= sprintf("%.2f", $shipping_cost) ?>
               </p>
            </div>
         </div>
         <div class="uk-card-footer">
            <div class="uk-flex uk-flex-between uk-flex-middle">
               <p class="uk-width-1-2 uk-text-bold">Te betalen</p>
               <p class="uk-width-1-2 uk-margin-remove-top uk-text-right uk-text-bold">
                  &euro; <?= sprintf("%.2f", $order_total) ?>
               </p>
            </div>
            <div class="uk-flex uk-flex-1 uk-flex-middle uk-flex-center uk-margin-medium-top">
               <a href="order.php" class="uk-button uk-button-primary">
                  Verder naar bestellen
               </a>
            </div>
         </div>
      </div>
   </section>
</div>
 </main>

 <script src="js/uikit.min.js"></script>
 <script src="js/uikit-icons.min.js"></script>
 <script src="js/main.js"></script>      
</body>

</html>
