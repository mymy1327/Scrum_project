<?php
session_start();
 
// destroy all session variables
$_SESSION = array();
 
// destroy the current session
session_destroy();
 
// Redirect to home page
header("location: Navigation_bar.html");
exit;
?>