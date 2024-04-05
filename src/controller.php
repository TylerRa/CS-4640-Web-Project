
<?php

class controller {

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
    $host = "db"; 
    $port = "5432";
    $database = "example"; 
    $user = "localuser"; 
    $password = "cs4640LocalUser!"; 

    $dbHandle = pg_connect("host=$host port=$port dbname=$database user=$user password=$password");
    
    // Set input
    $this->input = $input;

    // will load the list of items into db
    // $this->loadItems();
    $queryString = "
        CREATE TABLE IF NOT EXISTS users (
            user_id SERIAL PRIMARY KEY,
            username VARCHAR(50) UNIQUE NOT NULL,
            password VARCHAR(255) NOT NULL,
            email VARCHAR(100) UNIQUE NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            user_data JSONB
        )";
    $query = pg_prepare($dbHandle, $queryString ,$_POST["email"]);
    $res=pg_execute($dbHandle,$query);
    if (!$res) {
        $this->errorMessage = "error when creating users table";
    } 
}

/**
 * Run the server
 * 
 * Given the input (usually $_GET), then it will determine
 * which command to execute based on the given "command"
 * parameter.  Default is the welcome page.
 */
public function run() {
    // Get the command
    $command = "welcome";
    if (isset($this->input["command"]))
        $command = $this->input["command"];

    // NOTE: UPDATED 3/29/2024!!!!!
    // If the session doesn't have the key "name", AND they
    // are not trying to login (UPDATE!), then they
    // got here without going through the welcome page, so we
    // should send them back to the welcome page only.
    

    switch($command) {
        case "export":
            include("export.php");
            break;
        case "import":
            include("import.php");
            break;
        case "login":
            include("login.php");
            break;
        case "logout":
            include("logout.php");
            // no break; logout will also show the welcome page.
        default:
            include("index.html");
            break;
    }
}



}
