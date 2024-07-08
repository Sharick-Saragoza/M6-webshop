<?php

// Stap 1 - Controle of deze script via een POST-request is gestart
//                  NEE: Dan terug naar register form
if($_SERVER['REQUEST_METHOD'] != 'POST'){
    header('Location: ../register.php');
    exit();
}

// TODO: Stap 2 - Controleren in de $_POST array of alle velden ingevuld zijn
//                  NEE: Terug naar register form


// TODO: Stap 3 - Alle ingetikte gegevens opslaan in variabelen + beveiliging


// TODO: Stap 4 - Controle of het email adres al in de DB staat
//                  JA: Terug naar register form
//                      (OPTIONEEL MET BERICHT)


// TODO: Stap 5 - Toevoegen aan DB in de tabel klanten


// TODO: Stap 6 - Terug naar index.php