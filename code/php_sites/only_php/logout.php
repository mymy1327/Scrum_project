<?php
session_start();
 
// destroy all session variables
$_SESSION = array();
 
// destroy the current session
session_destroy();
 
// Redirect to home page
header("location: /scrum_project/code/php_sites/Navigation_bar.php");
exit;
?>