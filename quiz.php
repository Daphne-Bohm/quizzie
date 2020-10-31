<?php
    include_once 'header.php';
?>
    
    <!-- correct/not correct message -->
    <div class="not-correct" id="not-correct"></div>
    <div class="correct" id="correct"></div>

    <!-- quiz -->
    <div class="container-quiz" id="container-quiz">
        <div class="overlay"></div>
            <div class="question" id="container-question">
                <img id="question-image">
                <p id="question-here"></p>
            </div>
            <ul class="answers" id="container-answers">
            </ul>
        <div class="button-quiz">
            <button class="stop-btn" id="stop-btn">Stop the quiz</button>
        </div>
    </div>

    <script src="js/main.js"></script>
    <script src="js/quiz.js"></script>
</body>
</html>