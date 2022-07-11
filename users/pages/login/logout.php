<?php
if(!isset($_SESSION)) 
{ 
    session_start(); 
    setcookie ("PHPSESSID", "", time() - 3600, '/');
}

// Finally, destroy the session.    

session_destroy();
session_unset();
unset($_SESSION['PHPSESSID']);
$_SESSION = array();

// Include URL for Login page to login again.
header("Location: login.php");
exit;
?>