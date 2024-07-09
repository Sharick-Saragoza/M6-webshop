<?php

@include_once(__DIR__ . '/../incl/message.php');
@include_once(__DIR__ . '/../database/Database.php');

$is_error = false;

// CHECK 1 - CHECK Request type
if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    setError('registration-error', 'Vul a.u.b. dit formulier in om als klant te registreren...');
    header('Location: ../../register.php');
    exit();
}

// Functie om formulierdata te valideren
function validate_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

$old_values = [];

// CHECK 2 - Check of alle verplichte velden wel ingevuld zijn
if (!isset($_POST['voornaam']) || empty($_POST['voornaam'])) {
    setError('firstname-mandatory', 'Vul a.u.b. een voornaam in...');
    $is_error = true;
} else {
    setOldValue('voornaam', $_POST['voornaam']);
}

if (!isset($_POST['achternaam']) || empty($_POST['achternaam'])) {
    setError('lastname-mandatory', 'Vul a.u.b. een achternaam in...');
    $is_error = true;
} else {
    setOldValue('achternaam', $_POST['achternaam']);
}

if (!isset($_POST['straatnaam']) || empty($_POST['straatnaam'])) {
    setError('street-mandatory', 'Vul a.u.b. een straatnaam in...');
    $is_error = true;
} else {
    setOldValue('straatnaam', $_POST['straatnaam']);
}

if (!isset($_POST['huisnummer']) || empty($_POST['huisnummer'])) {
    setError('address-mandatory', 'Vul a.u.b. een huisnummer in...');
    $is_error = true;
} else {
    setOldValue('huisnummer', $_POST['huisnummer']);
}

if (!isset($_POST['postcode']) || empty($_POST['postcode'])) {
    setError('postal-mandatory', 'Vul a.u.b. een postcode in...');
    $is_error = true;
} else {
    setOldValue('postcode', $_POST['postcode']);
}

if (!isset($_POST['plaats']) || empty($_POST['plaats'])) {
    setError('city-mandatory', 'Vul a.u.b. een plaatsnaam in...');
    $is_error = true;
} else {
    setOldValue('plaats', $_POST['plaats']);
}

if (!isset($_POST['email']) || empty($_POST['email'])) {
    setError('email-mandatory', 'Vul a.u.b. een email adres in...');
    $is_error = true;
} else {
    setOldValue('email', $_POST['email']);
}

if (!isset($_POST['wachtwoord']) || empty($_POST['wachtwoord'])) {
    setError('password-mandatory', 'Vul a.u.b. een wachtwoord in...');
    $is_error = true;
}

setOldValue('tussenvoegsel', (isset($_POST['tussenvoegsel']) ? $_POST['tussenvoegsel'] : ''));
setOldValue('toevoeging', (isset($_POST['toevoeging']) ? $_POST['toevoeging'] : ''));

if ($is_error) {
    setError('registration-error', 'Vul a.u.b. alle verplichte velden in...');
    header('Location: ../../register.php');
    exit();
}

clearOldValues();

$voornaam = validate_input($_POST['voornaam']);
$achternaam = validate_input($_POST['achternaam']);
$tussenvoegsel = validate_input($_POST['tussenvoegsel']);
$straatnaam = validate_input($_POST['straatnaam']);
$huisnummer = validate_input($_POST['huisnummer']);
$toevoeging = validate_input($_POST['toevoeging']);
$postcode = validate_input($_POST['postcode']);
$plaats = validate_input($_POST['plaats']);
$email = validate_input($_POST['email']);
$wachtwoord = validate_input($_POST['wachtwoord']);

try {
    Database::query('INSERT INTO klanten (voornaam, tussenvoegsel, achternaam, huisnummer, straatnaam, toevoeging, postcode, plaats, email, wachtwoord) VALUES (:voornaam, :tussenvoegsel, :achternaam, :huisnummer, :straatnaam, :toevoeging, :postcode, :plaats, :email, :wachtwoord)', [
        ':voornaam' => $voornaam,
        ':tussenvoegsel' => $tussenvoegsel,
        ':achternaam' => $achternaam,
        ':huisnummer' => $huisnummer,
        ':straatnaam' => $straatnaam,
        ':toevoeging' => $toevoeging,
        ':postcode' => $postcode,
        ':plaats' => $plaats,
        ':email' => $email,
        ':wachtwoord' => password_hash($wachtwoord, PASSWORD_DEFAULT)
    ]);
    
    // Redirect naar een succespagina of een andere pagina na registratie
    header('Location: ../../index.php');
    exit();
} catch (Exception $e) {
    setError('registration-error', 'Er is een fout opgetreden bij het registreren. Probeer het opnieuw...');
    header('Location: ../../login.php');
    exit();
}

?>
