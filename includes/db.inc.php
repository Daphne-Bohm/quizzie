<?php

    $serverName = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbName = "quizproject";

    // Connection with database
    $conn = mysqli_connect($serverName, $dbUsername, $dbPassword, $dbName);

    // Give error when no connection
    if(!$conn){
        die("Connection failed: " . mysqli_connect_error());
    }