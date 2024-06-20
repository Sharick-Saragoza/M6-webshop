<!-- Include PHP login header -->
<?php 
include "incl/header.php";
?>

<!-- Style through PHP -->
<style>
<?php include 'styles/register.css'; ?>
</style>

<!-- Main -->
        <div class="grid-item main">
            <div class="register-card">
            <div class="form-group">
                <label class="data" for="firstname">Voornaam (Verplicht)</label>
                <input class="data" type="text" id="firstname" placeholder="Voornaam..." />
            </div>
            <br>
            <div class="form-group">
                <label class="data" for="lasttname">Achternaam (Verplicht)</label>
                <input class="data" type="text" id="lasttname" placeholder="Achternaam..." />
            </div>
            <br>
            <div class="form-group">
                <label class="data" for="infix">Tussenvoegsel </label>
                <input class="data" type="text" id="infix" placeholder="Tussenvoegsel..." />
            </div>
            <br>
            <div class="form-group">
                <label class="data" for="address">Huisnummer (Verplicht)</label>
                <input class="data" type="text" id="address" placeholder="00..." />
            </div>
            <br>
            <div class="form-group">
                <label class="data" for="street">Straatnaam (Verplicht)</label>
                <input class="data" type="text" id="street" placeholder="Straat..." />
            </div>
            <br>
            <div class="form-group">
                <label class="data" for="addition">Toevoeging </label>
                <input class="data" type="text" id="addition" placeholder="..." />
            </div>
            <br>
            <div class="form-group">
                <label class="data" for="postal code">Postcode (Verplicht)</label>
                <input class="data" type="text" id="postal code" placeholder="0000 XX" />
            </div>
            <br>
            <div class="form-group">
                <label class="data" for="place">plaats (Verplicht)</label>
                <input class="data" type="text" id="place" placeholder="plaats..." />
            </div>
            <br>
            <div class="form-group">
                <label class="data" for="email">email adress (Verplicht)</label>
                <input class="data" type="text" id="email" placeholder="email..." />
            </div>
            <br>
            <div class="form-group">
                <label class="data" for="password">wachtwoord (Verplicht)</label>
                <input class="data" type="text" id="password" placeholder="wachtwoord..." />
            </div>
            <br>
            <button class="block" type="submit">Registreren</button>
            </div>
        </div>

<!-- Include PHP footer -->
<?php 
include "incl/footer.php"
?>
