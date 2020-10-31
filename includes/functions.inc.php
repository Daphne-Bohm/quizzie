<?php

/////////////////////////////////////////////////////
/*                  REGISTER FUNC                  */
/////////////////////////////////////////////////////

/*****************EMPTY FIELDS**********************/
    function emptyInputRegister($username, $email, $password, $passwordRepeat){
        $result;
        if(empty($username) || empty($email) || empty($password) || empty($passwordRepeat)){
            $result = true;
        }else{
            $result = false;
        }
        return $result;
    }

/****************INVALID USERNAME********************/
    function invalidUsername($username){
        $result;
        if(!preg_match("/[a-zA-Z0-9 ]{2,}/", $username)){
            $result = true;
        }else{
            $result = false;
        }
        return $result;
    }

/****************INVALID EMAIL********************/
    function invalidEmail($email){
        $result;
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $result = true;
        }else{
            $result = false;
        }
        return $result;
    }


/****************INVALID PASSWORD********************/
    function invalidPassword($password){
        $result;
        if(strlen($password) < 7){
            $result = true;
        }else{
            $result = false;
        }
        return $result;
    }
    

/****************PASSWORD MATCH********************/
    function passwordMatch($password, $passwordRepeat){
        $result;
        if($password !== $passwordRepeat){
            $result = true;
        }else{
            $result = false;
        }
        return $result;
    }


    
/*************USERNAME/EMAIL ALREADY DB*****************/
    function usernameExistsInDB($conn, $username, $email){

        $sql = "SELECT * FROM users WHERE usersUsername = ? OR usersEmail = ?;";

        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("location: ../register.php?error=stmtfailed");
        }

        mysqli_stmt_bind_param($stmt, "ss", $username, $email);

        mysqli_stmt_execute($stmt);

        $resultData = mysqli_stmt_get_result($stmt);

        // dubbele functie
        if($row = mysqli_fetch_assoc($resultData)){ 
            return $row;
        }else{
            $result = false; 
            return $result;
        }
        mysqli_stmt_close($stmt);
    }



/*************YEAS SUCCES. CREATE USER******************/
    function createUser($conn, $username, $email, $password){
        $sql = "INSERT INTO users (usersUsername, usersEmail, usersPassword) VALUES (?, ?, ?);";

        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("location: ../register.php?error=stmtfailed");
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        mysqli_stmt_bind_param($stmt, "sss", $username, $email, $hashedPassword);

        mysqli_stmt_execute($stmt);

        mysqli_stmt_close($stmt);

        header("location: ../login.php?error=none");
    }


/////////////////////////////////////////////////////
/*                     LOGIN FUNC                  */
/////////////////////////////////////////////////////

/*****************EMPTY FIELDS**********************/
    function emptyInputLogin($username, $password){
        $result;
        if(empty($username) || empty($password)){
            $result = true;
        }else{
            $result = false;
        }
        return $result;
    }

    function loginUser($conn, $username, $password){

        $usernameExists = usernameExistsInDB($conn, $username, $username);

        if($usernameExists === false){
            header("location: ../register.php?error=wronglogin");
            exit();
        }

        $passwordHashed = $usernameExists["usersPassword"];
        $checkPassword = password_verify($password, $passwordHashed);

        if($checkPassword === false){
            header("location: ../register.php?error=wronglogin");

        }else if($checkPassword === true){
            session_start();

            $_SESSION["usersid"] = $usernameExists["usersID"];
            $_SESSION["usersusername"] = $usernameExists["usersUsername"];
            header("location: ../index.php");
            exit();

        }
        
    }


