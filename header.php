<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/style.css">
    <title>Quiz app</title>
</head>
<body>

    <header>
        <nav class="navigation-bar">
            <a href="index.php">
                <div class="logo-container">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0v24h24V0H0zm23 16c0 1.1-.9 2-2 2H3c-1.1 0-2-.9-2-2V8c0-1.1.9-2 2-2h18c1.1 0 2 .9 2 2v8z" fill="none"/><path id="gamepad" d="M21 6H3c-1.1 0-2 .9-2 2v8c0 1.1.9 2 2 2h18c1.1 0 2-.9 2-2V8c0-1.1-.9-2-2-2zm-10 7H8v3H6v-3H3v-2h3V8h2v3h3v2zm4.5 2c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5zm4-3c-.83 0-1.5-.67-1.5-1.5S18.67 9 19.5 9s1.5.67 1.5 1.5-.67 1.5-1.5 1.5z"/></svg>
                    <h1>Quizzie</h1>
                </div>
            </a>
            <div class="menu">
                <ul class="navlinks">

                    <!-- WHEN USER IS LOGGED IN-->
                    <li class="navlink" id="greeting">
                        <?php 
                            if(isset($_SESSION["usersid"])){
                                echo 'Hi, ' . $_SESSION["usersusername"] .'!';
                            }
                        ?>
                    </li>

                    <!-- BOTH: changing the color -->
                    <li class="navlink">
                                <a href="change-color.php">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0z" fill="none"/><path fill="#fff" d="M12 3c-4.97 0-9 4.03-9 9s4.03 9 9 9c.83 0 1.5-.67 1.5-1.5 0-.39-.15-.74-.39-1.01-.23-.26-.38-.61-.38-.99 0-.83.67-1.5 1.5-1.5H16c2.76 0 5-2.24 5-5 0-4.42-4.03-8-9-8zm-5.5 9c-.83 0-1.5-.67-1.5-1.5S5.67 9 6.5 9 8 9.67 8 10.5 7.33 12 6.5 12zm3-4C8.67 8 8 7.33 8 6.5S8.67 5 9.5 5s1.5.67 1.5 1.5S10.33 8 9.5 8zm5 0c-.83 0-1.5-.67-1.5-1.5S13.67 5 14.5 5s1.5.67 1.5 1.5S15.33 8 14.5 8zm3 4c-.83 0-1.5-.67-1.5-1.5S16.67 9 17.5 9s1.5.67 1.5 1.5-.67 1.5-1.5 1.5z"/></svg>
                                </a>
                    </li>

                    <!-- WHEN USER IS LOGGED IN-->
                    <?php //link to scoreboard through person symbol
                        if(isset($_SESSION["usersid"])){  
                            echo '<li class="navlink">
                                <a href="scoreboard.php">
                                    <svg id="person-24px" xmlns="http://www.w3.org/2000/svg" width="26.466" height="28.325" viewBox="0 0 26.466 28.325">
                                        <path id="Path_5" data-name="Path 5" d="M0,0H26.466V28.325H0Z" fill="none"/>
                                        <path id="Path_6" data-name="Path 6" d="M13.233,14.163a4.864,4.864,0,0,0,4.616-5.081A4.864,4.864,0,0,0,13.233,4,4.864,4.864,0,0,0,8.616,9.081,4.864,4.864,0,0,0,13.233,14.163Zm0,2.541C10.151,16.7,4,18.405,4,21.784v2.541H22.466V21.784C22.466,18.405,16.314,16.7,13.233,16.7Z" fill="#fff"/>
                                    </svg>
                                </a>
                            </li>';
                        }
                    ?>

                    <!-- WHEN USER IS LOGGED OUT -->
                    <?php // link to login page through person symbol
                        if(!isset($_SESSION["usersid"])){  
                            echo '<li class="navlink">
                                <a href="login.php">
                                    <svg id="person-24px" xmlns="http://www.w3.org/2000/svg" width="26.466" height="28.325" viewBox="0 0 26.466 28.325">
                                        <path id="Path_5" data-name="Path 5" d="M0,0H26.466V28.325H0Z" fill="none"/>
                                        <path id="Path_6" data-name="Path 6" d="M13.233,14.163a4.864,4.864,0,0,0,4.616-5.081A4.864,4.864,0,0,0,13.233,4,4.864,4.864,0,0,0,8.616,9.081,4.864,4.864,0,0,0,13.233,14.163Zm0,2.541C10.151,16.7,4,18.405,4,21.784v2.541H22.466V21.784C22.466,18.405,16.314,16.7,13.233,16.7Z" fill="#fff"/>
                                    </svg>
                                </a>
                            </li>';
                        }
                    ?>
   
                </ul>
            </div>
        </nav>
    </header>