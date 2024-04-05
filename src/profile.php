<?php
    
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


    $query = pg_prepare($dbHandle,"select * from example where email = $1;",$_SESSION["email"]);

    $res=pg_execute($dbHandle,$query);

    $password_regex="^\S*(?=\S*[a-z])(?=\S*[\d])\S*$";
    if (!isset($_POST['password'],$_POST['confirmpassword'])){
        ?><div class='alert alert-danger'>Please fill out all the fields first.</div><?php
    } 
   
    else if ($_POST['password']!=$_POST['confirmpassword']){
        ?><div class='alert alert-danger'>Please make sure your confirmed password matches the password.</div><?php
    }
    else if (!preg_match($password_regex,$_POST['password'])){
        ?><div class='alert alert-danger'>Your password must have at least 1 number.</div><?php
    }
    else if ($_POST['password']==$_POST['confirmedpassword'] && preg_match($password_regex,$_POST["password"])){
        $query=pg_prepare($dbHandle,"update users set password = $1 where email = $2;",password_hash($_POST["password"],PASSWORD_DEFAULT),$_SESSION["email"]);
        $res=pg_execute($dbHandle,$query);
        ?><div class="alert alert-success">Your password has been successfully updated.</div><?php
        return;
    }
