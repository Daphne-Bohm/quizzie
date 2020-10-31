<?php
    include_once 'header.php';
?>

    <main class="homepage" id="main">
        <div class="overlay" id="overlay"></div>
        <div class="homepage-content">
            <h1>Quizzie?</h1>
            <button class="start-btn" id="start-btn">Start</button>
            <div class="container-img-homepage">
                <img src="img/button.png" alt="game button" class="img-quiz">
            </div>
        </div>
    </main>

    <section class="info-quizzie" id="section">
        <div class="overlay" id="extra-overlay"></div>
        <h2>What is quizzie?</h2>
        <p>It is a fun quiz that works with the Open Trivia DB. You can test your knowledge and keep track of you scores. To save your score make an account clicking on the person symbol in the navigation bar. Click on the 'go to top button' to play the game.</p>
        <a href="index.php" class="go-to-top">Go to top</a>
    </section>

    <div class="choose-your-color" id="choose">
        <main class="colorspage">
            <div class="overlay"></div>
            <div class="colorspage-text">
                <h1 class="choose-color-title">Hi there! Welcome to Quizzie.</h1>
                <h2 class="choose-color-subtitle">Choose your color:</h2>
            </div>
            <ul class="colorspage-colors" id="chooseColor">
                <li class="blue colors" id="blue"></li>
                <li class="green colors" id="green"></li>
                <li class="yellow colors" id="yellow"></li>
                <li class="red colors" id="red"></li>
                <li class="orange colors" id="orange"></li>
                <li class="pink colors" id="pink"></li>
            </ul>
            <button id="chosenBtn">Send</button>
        </main>
    </div>


    <script src="js/main.js"></script>
    <script src="js/homepage.js"></script>
</body>
</html>