<?php
    include_once 'header.php';
?>
    
    <?php
        if(!isset($_SESSION["usersid"])):
    ?>
    
        <h1 class="message-please-login">Please login to see this page.</h1>

    <?php
        elseif(isset($_SESSION["usersid"])):
    ?>
    
        <main class="scoreboard">
            <h1>Your scoreboard</h1>
            <div class="overlay"></div>
                <ul class="scores">
                    <li class="score">
                        <div class="score-img" id="general">
                            <img src="img/general.png" alt="general category icon">
                        </div>
                        <p><span id="general-score"></span> points</p>
                    </li>
                    <li class="score">
                        <div class="score-img" id="music">
                            <img src="img/music.png" alt="music category icon">
                        </div>
                        <p><span id="music-score"></span> points</p>
                    </li> 
                    <li class="score">
                        <div class="score-img" id="math">
                            <img src="img/math.png" alt="math category icon">
                        </div>
                        <p><span id="math-score"></span> points</p>
                    </li>
                    <li class="score">
                        <div class="score-img" id="history">
                            <img src="img/history.png" alt="history category icon">
                        </div>
                        <p><span id="history-score"></span> points</p>
                    </li>
                    <li class="score">
                        <div class="score-img" id="animals">
                            <img src="img/animals.png" alt="animals category icon">
                        </div>
                        <p><span id="animals-score"></span> points</p>
                    </li>
                </ul>
                <a href="includes/logout.inc.php"><button class="btn-logout">Logout</button></a>
        </main>

        <?php endif; ?>

        <script src="js/main.js"></script>
        <script src="js/scoreboard.js"></script>
</body>
</html>