<?php
    include_once 'header.php';
?>

    <?php
        if(isset($_GET["error"])){
            
            if($_GET["error"] == "emptyinput"){
                echo '<p class="message-error">Not all fields are filled.</p>';
            }

            else if($_GET["error"] == "invalidusername"){
                echo '<p class="message-error">Username must contain at least two characters of letters or/and numbers.</p>';
            }

            else if($_GET["error"] == "invalidemail"){
                echo '<p class="message-error">Invalid email.</p>';
            }

            else if($_GET["error"] == "invalidpassword"){
                echo '<p class="message-error">Passwords must contain at least six characters.</p>';
            }

            else if($_GET["error"] == "passworddontmatch"){
                echo '<p class="message-error">Passwords do not match.</p>';
            }

            else if($_GET["error"] == "stmtfailed"){
                echo '<p class="message-error">Someting went wrong, please try again.</p>';
            }

            else if($_GET["error"] == "usernametaken"){
                echo '<p class="message-error">Username is already taken.</p>';
            }

        };
    ?>
                      
    <section class="register">
        <div class="overlay"></div>
        
        <div class="register-text">
            <h2>Register</h2>
        </div>
       
        <form action="includes/register.inc.php" method="post">

            <div class="form-input-register">
                <label for="username">Username:</label>
                <input type="text" name="username">
                <label for="email">Email:</label>
                <input type="email" name="email">
                <label for="email">Password:</label>
                <input type="password" name="password">
                <label for="password">Repeat password:</label>
                <input type="password" name="password-repeat">
            </div>

            <button class="btn-submit" type="submit" name="submit">Register</button>

        </form>

    </section>


<?php
    include_once 'footer.php';
?>