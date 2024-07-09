<?php

// Controleer of de gebruiker al ingelogd is, stuur ze dan door naar het dashboard
if (isset($_SESSION['email'])) {
    header('Location: index.php');
    exit;
}

// Inclusie van nodige bestanden en initialisatie van foutmeldingsvariabele
include_once(__DIR__ . '/helpers/Auth.php');
include_once(__DIR__ . '/helpers/Message.php');
$loginError = '';

// Verwerking van het inlogformulier
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Controleer of alle velden zijn ingevuld
    if (!empty($_POST['email']) && !empty($_POST['password'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        try {
            // Verbind met de database (vervang met jouw eigen database connectie)
            $pdo = new PDO('mysql:host=localhost;dbname=crocs', 'root', ''); // Vervang 'root' en '' met jouw MySQL gebruikersnaam en wachtwoord
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Bereid de query voor om de klant te vinden op basis van het e-mailadres
            $stmt = $pdo->prepare("SELECT * FROM klanten WHERE email = :email");
            $stmt->execute(['email' => $email]);
            $klant = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($klant && password_verify($password, $klant['wachtwoord'])) {
                // Gebruiker succesvol ingelogd, sla de email op in de sessie
                $_SESSION['email'] = $klant['email'];
                $_SESSION['klant_id'] = $klant['id']; // Optioneel, als je de klant-ID ook nodig hebt

                // Redirect naar het dashboard of een andere pagina na succesvol inloggen
                header('Location: index.php');
                exit;
            } else {
                // Onjuiste inloggegevens
                $loginError = "Incorrecte email of wachtwoord. Probeer het opnieuw.";
            }
        } catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    } else {
        // Niet alle velden zijn ingevuld
        $loginError = "Vul zowel email als wachtwoord in.";
    }
}
?>

<!-- Inclusie van je header -->
<?php include "incl/header.php"; ?>

<!-- Style through PHP -->
<style>
<?php include 'styles/register.css'; ?>
</style>

<div class="grid-item Login">
    <div class="login-card">
        <h2>Login</h2>
        <!-- Formulier voor inloggen -->
        <form method="POST" action="login.php">
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
        <!-- Weergave van foutmelding indien aanwezig -->
        <?php if (!empty($loginError)) { ?>
            <p class="error"><?php echo $loginError; ?></p>
        <?php } ?>
    </div>
    <br>
    <a style="color: white; text-decoration: none;" href="register.php">Don't have an account yet?</a>
</div>

<!-- Inclusie van je footer -->
<?php include "incl/footer.php"; ?>
