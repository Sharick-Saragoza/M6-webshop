<?php
session_start();

// Verwijder alle sessievariabelen
session_unset();

// Vernietig de sessie
session_destroy();

// Redirect naar de inlogpagina of een andere gewenste pagina na uitloggen
header('Location: login.php');
exit;
?>
