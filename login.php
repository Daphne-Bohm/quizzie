<?php
    include_once 'header.php';
?>

    <?php
        if(isset($_GET["error"])){
            if($_GET["error"] == "emptyinput"){
                echo '<p class="message-error">Please, fill in all fields.</p>';
            }
            else if($_GET["error"] == "wronglogin"){
                echo "<p>Incorrect login information.</p>";
            }
            else if($_GET["error"] == "none"){
                echo '<p class="message-succes">You have registered.</p>';
            }
        };
    ?>

    <section class="login">
        <div class="overlay"></div>
        
        <div class="login-text">
            <h2>Login</h2>
        </div>
        <form action="includes/login.inc.php" method="post">

            <div class="form-input-login">
                <label for="email">Username:</label>
                <input type="text" name="username">

                <label for="email">Password:</label>
                <input type="password" name="password">
            </div>

            <button class="btn-submit" type="submit" name="submit">Login</button>

        </form>

    </section>

    <p class="new-user">Are you new? <a href="register.php">Go to the register page.</a></p>

<?php
    include_once 'footer.php';
?>