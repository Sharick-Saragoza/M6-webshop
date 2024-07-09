<!-- Include PHP login header -->
<?php 
include "incl/header.php";
@include_once(__DIR__ . '/helpers/Auth.php');
@include_once(__DIR__ . '/helpers/Message.php');
?>

<!-- Style through PHP -->
<style>
<?php include 'styles/register.css'; ?>
</style>

<!-- Main -->
<div class="grid-item main">
    <form method="POST" action="formhandlers/register.php" class="register-card">
        <div class="form-group">
            <label class="data" for="firstname">Voornaam (Verplicht)</label>
            <input name="voornaam" class="data" type="text" id="firstname" placeholder="Voornaam..." />
        </div>
        <br>
        <div class="form-group">
            <label class="data" for="lasttname">Achternaam (Verplicht)</label>
            <input name="achternaam" class="data" type="text" id="lasttname" placeholder="Achternaam..." />
        </div>
        <br>
        <div class="form-group">
            <label class="data" for="infix">Tussenvoegsel</label>
            <input name="tussenvoegsel" class="data" type="text" id="infix" placeholder="Tussenvoegsel..." />
        </div>
        <br>
        <div class="form-group">
            <label class="data" for="address">Huisnummer (Verplicht)</label>
            <input name="huisnummer" class="data" type="text" id="address" placeholder="00..." />
        </div>
        <br>
        <div class="form-group">
            <label class="data" for="street">Straatnaam (Verplicht)</label>
            <input name="straatnaam" class="data" type="text" id="street" placeholder="Straat..." />
        </div>
        <br>
        <div class="form-group">
            <label class="data" for="addition">Toevoeging</label>
            <input name="toevoeging" class="data" type="text" id="addition" placeholder="..." />
        </div>
        <br>
        <div class="form-group">
            <label class="data" for="postal_code">Postcode (Verplicht)</label>
            <input name="postcode" class="data" type="text" id="postal_code" placeholder="0000 XX" />
        </div>
        <br>
        <div class="form-group">
            <label class="data" for="place">Plaats (Verplicht)</label>
            <input name="plaats" class="data" type="text" id="place" placeholder="Plaats..." />
        </div>
        <br>
        <div class="form-group">
            <label class="data" for="email">Email adres (Verplicht)</label>
            <input name="email" class="data" type="email" id="email" placeholder="Email..." />
        </div>
        <br>
        <div class="form-group">
            <label class="data" for="password">Wachtwoord (Verplicht)</label>
            <input name="wachtwoord" class="data" type="password" id="password" placeholder="Wachtwoord..." />
        </div>
        <br>
        <button class="block" type="submit">Registreren</button>
    </form>
</div>


<!-- Include PHP footer -->
<?php 
include "incl/footer.php";
?>
