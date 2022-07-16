<?php 
require_once "loginHelpers.php";

$email = $_POST["email"];
$password = $_POST["password"];
  
if (emptyLoginFields($email, $password)) {
  header("location: login.php?error=emptyFields");
  exit();
}
loginUser($email, $password);

