<?php
    session_start();
    $host = "db"; 
    $port = "5432";
    $database = "example"; 
    $user = "localuser"; 
    $password = "cs4640LocalUser!"; 

    $dbHandle = pg_connect("host=$host port=$port dbname=$database user=$user password=$password");

    if ($dbHandle) {
        echo "Success connecting to database";
    } 
    else {
        echo "An error occurred connecting to the database";
    }

    
    if (!isset($_POST['email'], $_POST['password']) ) {
        ?><div class='alert alert-danger'>Please fill out all the fields first.</div><?php
    }

    $query = pg_prepare($dbHandle,"select * from example where email = $1;",$_POST["email"]);

    $res=pg_execute($dbHandle,$query);

    if (empty($res)){    
        ?><div class='alert alert-danger'>Please sign up for an account first.</div><?php
        header("Location: ../signup.html");
        return;
    }
    else{
        if (password_verify($_POST["password"], $res[0]["password"])) {
            // Password was correct, save their information to the
            // session and send them to the question page
         
            //$_SESSION["email"] = $res[0]["email"];
            header("Location: ../viewBuilds.html");
            return;
        } 
        else {
            // Password was incorrect
            ?><div class='alert alert-danger'>Incorrect password.</div><?php
        }

    }

