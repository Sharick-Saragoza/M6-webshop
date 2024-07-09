
<?php

@include_once(__DIR__."/../incl/message.php");
@include_once(__DIR__."/../database.php");

$is_error = false;

// CHECK 1 - CHECK Request type
if ($_SERVER['REQUEST_METHOD'] != 'POST') {
   // Geen POST-request dus stoppen we
   // We keren terug naar de login pagina
   setError('registration-error', 'Vul a.u.b. dit formulier in om als klant te registreren...');
   header('Location: ../../register.php');
   exit();
}

$old_values = [];

// CHECK 2 - Check of alle verplichte velden wel ingevuld zijn
if(!isset($_POST['firstname']) || empty($_POST['firstname'])) {
   setError('firstname-mandatory', 'Vul a.u.b. een voornaam in...');
   $is_error = true;
} else
   setOldValue('firstname', $_POST['firstname']);

if (!isset($_POST['lastname']) || empty($_POST['lastname'])) {
   setError('lastname-mandatory', 'Vul a.u.b. een achternaam in...');
   $is_error = true;
} else
   setOldValue('lastname', $_POST['lastname']);


if (!isset($_POST['street']) || empty($_POST['street'])) {
   setError('street-mandatory', 'Vul a.u.b. een straatnaam in...');
   $is_error = true;
} else
   setOldValue('street', $_POST['street']);


if (!isset($_POST['address']) || empty($_POST['address'])) {
   setError('address-mandatory', 'Vul a.u.b. een huisnummer in...');
   $is_error = true;
} else
   setOldValue('address', $_POST['address']);


if (!isset($_POST['postal']) || empty($_POST['postal'])) {
   setError('postal-mandatory', 'Vul a.u.b. een postcode in...');
   $is_error = true;
} else
   setOldValue('postal', $_POST['postal']);


if (!isset($_POST['city']) || empty($_POST['city'])) {
   setError('city-mandatory', 'Vul a.u.b. een plaatsnaam in...');
   $is_error = true;
} else
   setOldValue('city', $_POST['city']);


if (!isset($_POST['email']) || empty($_POST['email'])) {
   setError('email-mandatory', 'Vul a.u.b. een email adres in...');
   $is_error = true;
} else
   setOldValue('email', $_POST['email']);


if (!isset($_POST['password']) || empty($_POST['password'])) {
   setError('password-mandatory', 'Vul a.u.b. een wachtwoord in...');
   $is_error = true;
}

setOldValue('infix', (isset($_POST['infix']) ? $_POST['infix'] : ''));
setOldValue('addition', (isset($_POST['addition']) ? $_POST['addition'] : ''));

// if($is_error) {
//    setError('registration-error', 'Vul a.u.b. alle verplichte velden in...');
//    header('Location: ../register.php');
//    exit();
// }

clearOldValues();

$firstname = htmlentities($_POST['firstname']);
$lastname = htmlentities($_POST['lastname']);
$infix = htmlentities($_POST['infix']);
$street = htmlentities($_POST['street']);
$address = htmlentities($_POST['address']);
$addition = htmlentities($_POST['addition']);
$postal = htmlentities($_POST['postal']);
$city = htmlentities($_POST['city']);
$email = htmlentities($_POST['email']);
$password = htmlentities($_POST['password']);

Database::insert('customers',[
   'firstname' => $firstname,
   'infix' => $infix,
   'lastname' => $lastname,
   'street' => $street,
   'address' => $address,
   'addition' => $addition,
   'postal' => $postal,
   'city' => $city,
   'email' => $email,
   'password' => password_hash($password, PASSWORD_DEFAULT)
]);
exit();