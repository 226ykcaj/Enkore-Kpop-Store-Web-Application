<?php
    // to check if the input of email and pwd is empty
    function emptyInput($email, $pwd){
        $result = null;
        if(empty($email) || empty($pwd)){
            $result = true;
        }else{
            $result = false;
        }
        return $result;
    }
    // to check if the email already exist or not by returning the result
    function emailExists($conn, $email){
        // to retrieve the user details using the usersEmail
        $sql = "SELECT * FROM users WHERE usersEmail = ?;";
        // to initialize the prepared stmt
        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt, $sql)){
            // prompt the user to login page with the error
            header("location:../account.php?error=stmtfailed");
            exit();
        }

        mysqli_stmt_bind_param($stmt,"s", $email);

        mysqli_stmt_execute($stmt);
        
        $resultData = mysqli_stmt_get_result($stmt);

        mysqli_stmt_close($stmt);
        // if useremail already exist, return the email, if not, return false
        if($row = mysqli_fetch_assoc($resultData)){
            return $row;
        }else{
            return false;
        }

        mysqli_free_result($resultData);
    }

    function createUser($conn, $email, $pwd){
        $sql = "INSERT INTO users (usersEmail,usersPassword) VALUES (?, ?);";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("location:../account.php?error=stmtfailed");
            exit();
        }
        // to hash password using default algorithm
        $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

        mysqli_stmt_bind_param($stmt,"ss", $email, $hashedPwd);

        mysqli_stmt_execute($stmt);

        mysqli_stmt_close($stmt);
        // to retrieve the user details with an associative array according to the email
        $emailExists = emailExists($conn, $email);

        session_start();
        // assign userid to session userid
        $_SESSION["userid"] = $emailExists["usersId"];
        // prompt to index page
        header("location:../index.php?successful login");
        exit();
    }

    function loginUser($conn, $email, $pwd){
        // to retrieve user details
        $emailExists = emailExists($conn, $email);
        // check if the email exists
        if($emailExists === false){
            // prompt user to account page with related error
            header("location:../account.php?error=Wrong email");
            exit();
        }

        $pwdHashed = $emailExists["usersPassword"];
        // to verify if the password is same as the hashedpwd
        $checkPwd = password_verify($pwd, $pwdHashed);
        

        if($checkPwd === false){
            // to prompt user to account page with related error
            header("location:../account.php?error=" . urlencode("Wrong password"));
            exit();
        }else if($checkPwd === true){
            // prompt user to index page and assign user id into the session
            session_start();
            $_SESSION["userid"] = $emailExists["usersId"];
            header("location:../index.php?" . urlencode("Successful login"));
            exit();
        }

    }

    function customErrorHandler($errno, $errstr, $errfile, $errline) {
        // set the timezone as kl
        date_default_timezone_set('Asia/Kuala_Lumpur');
        // Get current timestamp
        $timestamp = date('d-m-Y h:i:s A'); 
        $message = "Error: [$errno] $errstr - $errfile:$errline";
        // to log the error msg into error_log.txt
        error_log("[$timestamp] $message" . PHP_EOL, 3, "error_log.txt");
    }