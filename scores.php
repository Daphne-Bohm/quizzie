<?php
    include_once 'header.php';
?>

<?php

    require_once 'includes/db.inc.php';

        // GET THE DATA FROM LS 
        if(isset($_GET["general"])) $general = $_GET["general"];
        if(isset($_GET["music"])) $music = $_GET["music"];
        if(isset($_GET["math"])) $math = $_GET["math"];
        if(isset($_GET["history"])) $history = $_GET["history"];
        if(isset($_GET["animals"])) $animals = $_GET["animals"];

        // GET THE USERNAME FROM SESSION / USER IS LOGGED IN
        if(isset($_SESSION["usersid"])){

            //GET THE DATA FROM THE DATABASE
            $sqlSel = "SELECT * from users WHERE usersUsername = '$getUser'";
            $querySel = mysqli_query($conn, $sqlSel);
            
            while($row = mysqli_fetch_array($querySel)){
                $generalDB = $row['general'];
                $musicDB = $row['music'];
                $mathDB = $row['math'];
                $historyDB = $row['history'];
                $animalsDB = $row['animals']; 
            }
    
            // UPDATE SCORES
            // (1) User comes back with clean history and with an account
            // (2) User plays the quiz for the first time and made an account
            // (3) User comes back with no clean history and with an account, LS is still active

            $array = array('general' => $general, 'music' => $music, 'math' => $math, 'history' => $history, 'animals' => $animals);
            $sum = 0;
            $cat;

            // GET THE VALUES THAT ARE 0 -> means not played. 1, 2 or 3?
            foreach ($array as $value){ 
                if($value == 0){
                    $sum++;
                }
            } 

            if($sum === 4){ // (1) (2)

                if(mysqli_num_rows($querySel) == 1){ 
                    
                    // A. GET THE VALUES THAT ARE 0 -> 1 or 2?
                    $sumDB = 0;
                    $arrayDB = array('general' => $generalDB, 'music' => $musicDB, 'math' => $mathDB, 'history' => $historyDB, 'animals' => $animalsDB);
                    foreach ($arrayDB as $value){ 
                        if($value == 0){
                            $sumDB++;
                        }
                    } 

                    if($sum === 5){ // (2)
                        
                        $newGeneral = $general;
                        $newMusic = $music;
                        $newMath = $math;
                        $newHistory = $history;
                        $newAnimals = $animals;

                        // INSERT THE DATA TO THE DATABASE
                        $sqlIns = "UPDATE users SET general = '$newGeneral', music = '$newMusic', math = '$newMath', history = ' $newHistory', animals = '$newAnimals' WHERE usersUsername = '$getUser'";

                        $queryIns = mysqli_query($conn, $sqlIns);

                        if(!$queryIns) {
                            header("location: scores.php?error=updateDBfailed");
                        }else{
                            // SEND TOTALSCORES TO URL FOR JS LOCAL STORAGE
                            header("location: scores.php?general='$newGeneral'&music='$newMusic'&math='$newMath'&history='$newHistory'&animals='$newAnimals'");
                        }

                    }else{ // (1)
                    
                        $newGeneral = $generalDB + $general;
                        $newMusic = $musicDB + $music;
                        $newMath = $mathDB + $math;
                        $newHistory = $historyDB + $history;
                        $newAnimals = $animalsDB + $animals;

                        // INSERT THE DATA TO THE DATABASE
                        $sqlIns = "UPDATE users SET general = '$newGeneral', music = '$newMusic', math = '$newMath', history = ' $newHistory', animals = '$newAnimals' WHERE usersUsername = '$getUser'";

                        $queryIns = mysqli_query($conn, $sqlIns);

                        if(!$queryIns) {
                            header("location: scores.php?error=updateDBfailed");
                        }else{
                            // SEND TOTALSCORES TO URL FOR JS LOCAL STORAGE
                            header("location: scores.php?general='$newGeneral'&music='$newMusic'&math='$newMath'&history='$newHistory'&animals='$newAnimals'");
                        }

                    }

                }

                }else if($sum < 4){ // 3

                    $newGeneral = $general;
                    $newMusic = $music;
                    $newMath = $math;
                    $newHistory = $history;
                    $newAnimals = $animals;
                    
                    // INSERT THE DATA TO THE DATABASE
                    $sqlIns = "UPDATE users SET general = '$newGeneral', music = '$newMusic', math = '$newMath', history = ' $newHistory', animals = '$newAnimals' WHERE usersUsername = '$getUser'";

                    $queryIns = mysqli_query($conn, $sqlIns);

                    if(!$queryIns) {
                        header("location: scores.php?error=updateDBfailed");
                    }else{
                        // SEND TOTALSCORES TO URL FOR JS LOCAL STORAGE
                        header("location: scores.php?general='$newGeneral'&music='$newMusic'&math='$newMath'&history='$newHistory'&animals='$newAnimals'");
                    }

            }
            
            // CLOSE CONNECTION DB
            mysqli_close($conn);


        }
        
?>

    <main class="display-score-container">

    <div class="wrong-correct-answer" id="wrong-correct-answer">
        <div class="overlay"></div>
        <img id="img-question">
        <p class="correct-answered">Correct answered: <span id="result-correct"></span></p>
        <p class="wrong-answered">Wrong answered: <span id="result-wrong"></span></p>
    </div>

    <a href="index.php">Go back to homepage</a>

    </main>

    <script src="js/main.js"></script>
    <script src="js/scores.js"></script>
</body>
</html>
