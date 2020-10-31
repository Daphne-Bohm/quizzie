<?php

if(isset($_POST["submit"])){
    $username = $_POST["username"];
    $password = $_POST["password"];
    
    require_once 'db.inc.php';
    require_once 'functions.inc.php';

    // ERROR HANDLING
    if(emptyInputLogin($username, $password) !== false){
        header("location: ../login.php?error=emptyinput");
        exit();
    }

    // SUCCES
    loginUser($conn, $username, $password);

}else{

    header("location: ../login.php");
    exit();

};