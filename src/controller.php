<?php

class Controller {

    private $db;

    // An error message to display on the welcome page
    private $errorMessage = "";

    /**
     * Constructor
     */
    public function __construct($input) {
        // We should always start (or join) a session at the top
        // of execution of PHP -- the constructor is the best place
        // to do that.
        session_start(); // start a session!
        
        // Connect to the database by instantiating a
        // Database object (provided by CS4640).  You have a copy
        // in the src/example directory, but it will be below as well.
        $this->db = new Database();

        // Set input
        $this->input = $input;

    }

    
    public function run() {
        // Get the command
        $command = "welcome";
        if (isset($this->input["command"]))
            $command = $this->input["command"];

        
        if (!isset($_SESSION["name"]) && $command != "login")
            $command = "welcome";

        switch($command) {
            case "signUp":
                $this->signUp();
                break;
            case "login":
                $this->login();
                break;
            case "profile":
                $this->profile();
            case "logout":
                $this->logout();
                // no break; logout will also show the welcome page.
            default:
                $this->showWelcome();
                break;
        }
    }

    /**
     * Login Function
     *
     * This function checks that the user submitted the form and did not
     * leave the name and email inputs empty.  If all is well, we set
     * their information into the session and then send them to the 
     * question page.  If all didn't go well, we set the class field
     * errorMessage and show the welcome page again with that message.
     *
     * NOTE: This is the function we wrote in class!  It **should** also
     * check more detailed information about the name/email to make sure
     * they are valid.
     */
    public function login() {
        if (!isset($_POST['email'], $_POST['password']) ) {
            $this->errorMessage="Please fill out all the fields first.";
        }
    
        $query = $this->db->query("select * from users where email = $1;",$_POST["email"]);
    
        if (empty($query)){    
            ?><div class='alert alert-danger'>Please sign up for an account first.</div><?php
            header("Location: /students/qh8cz/public_html/final_project/signup.html"); // /CS-4640-Web-Project/
            return;
        }
        else{
            if (password_verify($_POST["password"], $query[0]["password"])) {
                // Password was correct, save their information to the
                // session and send them to the question page
             
                $_SESSION["email"] = $query[0]["email"]; ///CS-4640-Web-Project/  /students/qh8cz/public_html/final_project/
                header("Location: /students/qh8cz/public_html/final_project/viewBuilds.html");
                return;
            } 
            else {
                // Password was incorrect
                $this->errorMessage="Incorrect Password.";
                
            }
    
        }
    }
    public function signUp(){
        $password_regex="^\S*(?=\S*[a-z])(?=\S*[\d])\S*$";
    if (!isset($_POST['email'], $_POST['password'],$_POST['confirmpassword'])){
        $this->errorMessage="Please fill out all the fields first.";
        echo "<h4>{$this->errorMessage}</h4>";
        return;
    } 
    else if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){ //validate form data
        $this->errorMessage="Please enter a valid email.";
        echo "<h4>{$this->errorMessage}</h4>";
        return;
    }
    else if ($_POST['password']!=$_POST['confirmpassword']){
        $this->errorMessage="Please make sure your confirmed password matches your password.";
        echo "<h4>{$this->errorMessage}</h4>";
        return;
    }
    else if (!preg_match($password_regex,$_POST['password'])){
        $this->errorMessage="Your password must have at least 1 letter and 1 number.";
        echo "<h4>{$this->errorMessage}</h4>";
        return;
    }
    else if ($_POST['password']==$_POST['confirmpassword'] && preg_match($password_regex,$_POST["password"])){
        $query=$this->db->query("select * from users where email = $1;",$_POST["email"]);
   
        if (!empty($query)){    
            
            $this->errorMessage="You already have an account! Please log in";
            echo "<h4>{$this->errorMessage}</h4>";
            return; ///var/www/html/CS-4640-Web-Project/ /students/qh8cz/public_html/final_project/
        }
        $this->db->query("insert into users (email, password) values ($1, $2);",
                         $_POST["email"],
                        // Use the hashed password!
                        password_hash($_POST["password"], PASSWORD_DEFAULT));

                    //$_SESSION["email"] = $_POST["email"];
        ///CS-4640-Web-Project/ /students/qh8cz/public_html/final_project/
        header("Location: /students/qh8cz/public_html/final_project/viewBuilds.html");
    }
    }
   /*
    public function loginDatabase() {
        // User must provide a non-empty name, email, and password to attempt a login
        if(isset($_POST["fullname"]) && !empty($_POST["fullname"]) &&
            isset($_POST["email"]) && !empty($_POST["email"]) &&
            isset($_POST["passwd"]) && !empty($_POST["passwd"])) {

                // Check if user is in database, by email
                $res = $this->db->query("select * from users where email = $1;", $_POST["email"]);
                if (empty($res)) {
                    // User was not there (empty result), so insert them
                    $this->db->query("insert into users (name, email, password, score) values ($1, $2, $3, $4);",
                        $_POST["fullname"], $_POST["email"],
                        // Use the hashed password!
                        password_hash($_POST["passwd"], PASSWORD_DEFAULT), 0);
                    $_SESSION["name"] = $_POST["fullname"];
                    $_SESSION["email"] = $_POST["email"];
                    $_SESSION["score"] = 0;
                    // Send user to the appropriate page (question)
                    header("Location: ?command=question");
                    return;
                } else {
                    // User was in the database, verify password is correct
                    // Note: Since we used a 1-way hash, we must use password_verify()
                    // to check that the passwords match.
                    if (password_verify($_POST["passwd"], $res[0]["password"])) {
                        // Password was correct, save their information to the
                        // session and send them to the question page
                        $_SESSION["name"] = $res[0]["name"];
                        $_SESSION["email"] = $res[0]["email"];
                        $_SESSION["score"] = $res[0]["score"];
                        header("Location: ?command=question");
                        return;
                    } else {
                        // Password was incorrect
                        $this->errorMessage = "Incorrect password.";
                    }
                }
        } else {
            $this->errorMessage = "Name, email, and password are required.";
        }
        // If something went wrong, show the welcome page again
        $this->showWelcome();
    }

     * Logout
     *
     * Destroys the session, essentially logging the user out.  It will then start
     * a new session so that we have $_SESSION if we need it.
     */
    public function logout() {
        session_destroy();
        session_start();
        $this->showWelcome();
    }
    
    public function profile(){
        $query = $this->db->query("select * from users where email = $1;",$_SESSION["email"]);

        $password_regex="^\S*(?=\S*[a-z])(?=\S*[\d])\S*$";
        if (!isset($_POST['password'],$_POST['confirmpassword'])){
            $this->errorMessage="Please fill out all the fields first.";
        
        } 
   
        else if ($_POST['password']!=$_POST['confirmpassword']){
            $this->errorMessage="Please make sure your confirmed password matches the password.";
        
        }
        else if (!preg_match($password_regex,$_POST['password'])){
            $this->errorMessage="Your password must have at least 1 letter and 1 number."; 
        }
        else if ($_POST['password']==$_POST['confirmpassword'] && preg_match($password_regex,$_POST["password"])){
        $query=$this->db->query("update users set password = $1 where email = $2;",password_hash($_POST["password"],PASSWORD_DEFAULT),$_SESSION["email"]);
            $this->errorMessage="Your password has been updated successfully.";
        
    }

    }
    /**
     * Show the welcome page to the user.
     */
    public function showWelcome() {
        
        $message = "";
        if (!empty($this->errorMessage)) {
            $message = "<div class='alert alert-danger'>{$this->errorMessage}</div>";
        }
        header("Location: /student/qh8cz/public_html/final_project/index.html");// /CS-4640-Web-Project/ /student/qh8cz/public_html/final_project/
    }

  
}
