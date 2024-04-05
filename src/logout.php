<?php

session_destroy();
session_start();
// Redirect to the login page:
header('Location: index.html');
?>