<?php
    session_start();
    $host = "db"; 
    $port = "5432";
    $database = "example"; 
    $user = "qh8cz"; 
    $password = "cRZawg3Nj4UY"; 

    $dbHandle = pg_connect("host=$host port=$port dbname=$database user=$user password=$password");

    if ($dbHandle) {
        echo "Success connecting to database";
    } 
    else {
        echo "An error occurred connecting to the database";
    }

////////////
    $password_regex="^\S*(?=\S*[a-z])(?=\S*[\d])\S*$";
    if (!isset($_POST['email'], $_POST['password'],$_POST['confirmpassword'])){
        ?><div class='alert alert-danger'>Please fill out all the fields first.</div><?php
    } 
    else if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){ //validate form data
        ?><div class='alert alert-danger'>Please enter a valid email.</div><?php
    }
    else if ($_POST['password']!=$_POST['confirmpassword']){
        ?><div class='alert alert-danger'>Please make sure your confirmed password matches the password.</div><?php
    }
    else if (!preg_match($password_regex,$_POST['password'])){
        ?><div class='alert alert-danger'>Your password must have at least 1 number.</div><?php
    }
    else if ($_POST['password']==$_POST['confirmedpassword'] && preg_match($password_regex,$_POST["password"])){
        $query=pg_prepare($dbHandle,"select * from example where email = $1;",$_POST["email"]);
        $res=pg_execute($dbHandle,$query);
   
        if (!empty($res)){    
            ?><div class='alert alert-danger'>You already have an account with this email! Please log in instead.</div><?php
            header("Location: ../login.html");
            return;
        }
        $query=pg_prepare($dbHandle,"insert into example (email, password) values ($1, $2);",
                         $_POST["email"],
                        // Use the hashed password!
                        password_hash($_POST["password"], PASSWORD_DEFAULT));

                    //$_SESSION["email"] = $_POST["email"];
        $res=pg_execute($dbHandle,$query);
        header("Location: ../viewBuilds.html");
    }



