
<?php
//https://cs4640.cs.virginia.edu/hjy4kh/project/index.html
//Author: Tyler Rasmussen

error_reporting(E_ALL);
ini_set("display_errors", 1);

// Class autoloading by name.  All our classes will be in a directory
// that Apache does not serve publicly.  They will be in /opt/src/, which
// is our src/ directory in Docker.
spl_autoload_register(function ($classname) {
        include "$classname.php";
});

// Other global things that we need to do
// (such as starting a session, coming soon!)

// Instantiate the front controller
$leg = new controller($_GET);

// Run the controller
$leg->run();