<!-- Include PHP login header -->
<?php 
include "incl/header.php";
?>

<!-- Style through PHP -->
<style>
<?php include 'styles/register.css'; ?>
</style>

        <div class="grid-item Login">
            <div class="login-card">
                <h2>Login</h2>
                <form>
                    <input type="text" placeholder="Username" required>
                    <input type="password" placeholder="Password" required>
                    <button type="submit">Login</button>
                </form>
            </div>
            <br>
            <a style="color: white; text-decoration: none;" href="register.php">Don't have an account yet?</a>
        </div>

<!-- Include PHP footer -->
<?php 
include "incl/footer.php"
?>
