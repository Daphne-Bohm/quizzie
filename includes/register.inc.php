<?php

    if(isset($_POST["submit"])){

        $username = $_POST["username"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $passwordRepeat = $_POST["password-repeat"];

        require_once 'db.inc.php';
        require_once 'functions.inc.php';

        // ERROR HANDLING
        if(emptyInputRegister($username, $email, $password, $passwordRepeat) !== false){
            header("location: ../register.php?error=emptyinput");
            exit();
        }

        if(invalidUsername($username) !== false){
            header("location: ../register.php?error=invalidusername");
            exit();
        }

        if(invalidEmail($email) !== false){
            header("location: ../register.php?error=invalidemail");
            exit();
        }

        if(invalidPassword($password) !== false){
            header("location: ../register.php?error=invalidpassword");
            exit();
        }

        if(passwordMatch($password, $passwordRepeat) !== false){
            header("location: ../register.php?error=passworddontmatch");
            exit();
        }

        if(usernameExistsInDB($conn, $username, $email) !== false){
            header("location: ../register.php?error=usernametaken");
            exit();
        }

        // SUCCES
        createUser($conn, $username, $email, $password);

    }else{
        header("location: ../register.php");
        exit();
    }
