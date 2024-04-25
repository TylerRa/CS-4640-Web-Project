<?php

class Controller {

    private $db;

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

        switch($command) {
            case "signUp":
                $this->signUp();
                break;
            case "login":
                $this->login();
                break;
            case "profile":
                $this->profile();
                break;
        
            case "saveToProfile":
                $this->saveToProfile();
                break;
            case "retrieveBuilds":
                $this->retrieveBuilds();
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
            $_SESSION['errorMessage']="Please fill out all the fields first.";
            header("Location: login.php");
            exit;
        }
        $query = $this->db->query("select * from public.users where email = $1;",$_POST["email"]);
        if (empty($query)){    
            $_SESSION['errorMessage']="You don't have an account, please sign up first.";
            header("Location: signup.php");
            exit; 
        }
        
        else{
            if (password_verify($_POST["password"], $query[0]["password"])) {
                $_SESSION["email"] = $query[0]["email"]; 
                header("Location: viewBuilds.php");
                exit;
            } 
            else {
                $_SESSION['errorMessage']="Incorrect Password.";
                header("Location: login.php");
                exit;
            }
        }
    }
    public function signUp(){
        $password_regex="/^\S*(?=\S*[a-z])(?=\S*[\d])\S*$/";
        if (!isset($_POST['email'], $_POST['password'],$_POST['confirmpassword'])){
            $_SESSION['errorMessage']="Please fill out all the fields first.";
            header("Location: signup.php");
            exit;
        } 
        
        else if ($_POST['password']!=$_POST['confirmpassword']){
            $_SESSION['errorMessage']="Please make sure your confirmed password matches your password.";
            header("Location: signup.php");
            exit;
        
        }
        else if (!preg_match($password_regex,$_POST['password'])){
            $_SESSION['errorMessage']="Your password must have at least 1 letter and 1 number.";
            header("Location: signup.php");
            exit;
        }
        else if ($_POST['password']==$_POST['confirmpassword'] && preg_match($password_regex,$_POST["password"])){
            //var_dump($_POST['email'],$_POST['password'],$_POST['confirmpassword']);
            $query=$this->db->query("select * from public.users where email = $1;",$_POST["email"]);
        
            if (!empty($query)){    
                $_SESSION['errorMessage']="You already have an account! Please log in";
                header("Location: signup.php");
                exit;
            }
            $this->db->query("insert into public.users (email, password) values ($1, $2);",$_POST["email"],password_hash($_POST["password"], PASSWORD_DEFAULT));

            $_SESSION["email"] = $query[0]["email"];
            header("Location: viewBuilds.php");
            exit;
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
        $query=$this->db->query("select * from public.users where email = $1;",$_SESSION["email"]);
        
        $password_regex="/^\S*(?=\S*[a-z])(?=\S*[\d])\S*$/";
        if (!isset($_POST['password'],$_POST['confirmpassword'])){
            $_SESSION['errorMessage']="Please fill out all the fields first.";
            header("Location: profile.php");
            exit;
        } 
   
        else if ($_POST['password']!=$_POST['confirmpassword']){
            $_SESSION['errorMessage']="Please make sure your confirmed password matches the password.";
            header("Location: profile.php");
            exit;
        }
        if ($_POST['password']==$_POST['confirmpassword']){
            if (!preg_match($password_regex,$_POST['password'])){
                $_SESSION['errorMessage']="Your new password must have at least 1 letter and 1 number."; 
                header("Location: profile.php");
                exit;
            }
            else if ($_POST["password"]==password_verify($query[0]['password'],PASSWORD_DEFAULT)){
                $_SESSION['errorMessage']="Your password must be different than the original!";
                header("Location: profile.php");
                exit;
            }
            else if (preg_match($password_regex,$_POST["password"]) && $_POST["password"]!=password_verify($query[0]['password'],PASSWORD_DEFAULT)){
                $this->db->query("update public.users set password = $1 where email = $2;",password_hash($_POST["password"],PASSWORD_DEFAULT),$_SESSION["email"]);
                $_SESSION['errorMessage']="Your password has been updated successfully.";
                header("Location: profile.php");
                exit;
            }
        
        }

    }
    /**
     * Show the welcome page to the user.
     */
    public function showWelcome() {
        header("Location: indexhtml.php");
    }
    
    public function saveToProfile(){
        $arr=[
            'attackDamage' => $_POST['attackDamage'],
            'abilityPower' => $_POST['abilityPower'],
            'attackSpeed' => $_POST['attackSpeed'],
            'lethality' => $_POST['lethality'],
            'criticalStrikeChance' => $_POST['criticalStrikeChance'],
            'armorPenetration' => $_POST['armorPenetration'],
            'magicPenetration' => $_POST['magicPenetration'],
            'onHitPhysicalDamage' => $_POST['onHitPhysicalDamage'],
            'onHitTrueDamage' => $_POST['onHitTrueDamage'],
            'onHitMagicDamage' => $_POST['onHitMagicDamage']
        ];
        
        if ($_SESSION['email']===null){
            $_SESSION['errorMessage']="Please sign up or log in first to save your builds.";
            header("Location: indexhtml.php");
            exit;
        }
        $query=$this->db->query("select * from public.users where email=$1;",$_SESSION['email']);
        
        $curBuilds=[];
        if (($query[0]['builds']!=null)){
            $curBuilds=json_decode($query[0]['builds']);
        }
       
        $curBuilds[]=$arr;
        $newBuild=json_encode($curBuilds);
        $this->db->query("update public.users set builds=$1 where email=$2;",$newBuild,$_SESSION['email']);
        $_SESSION['errorMessage']="Successfully saved champion stats to profile.";
        header("Location: indexhtml.php");
        exit;
    }

    public function retrieveBuilds(){
        $builds=$this->db->query("select builds from public.users where email=$1;",$_SESSION['email']);
        echo json_encode($builds);
        //header("Location: viewBuilds.php");
    }
}
