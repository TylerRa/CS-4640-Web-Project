<?php

// DEBUGGING ONLY! Show all errors.
error_reporting(E_ALL);
ini_set("display_errors", 1);

// Class autoloading by name.  All our classes will be in a directory
// that Apache does not serve publicly.  They will be in /opt/src/, which
// is our src/ directory in Docker.
spl_autoload_register(function ($classname) {
        include "/students/qh8cz/students/qh8cz/private/$classname.php"; // /opt/src/project/ /students/qh8cz/students/qh8cz/private/
});

// Instantiate the front controller
$controller = new Controller($_GET);

// Run the controller
$controller->run();

