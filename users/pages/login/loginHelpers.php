<?php
require_once "database.php";
/*
Useful way to debug to the terminal
  error_log(print_r("✅", true)); // this is to make it easier to see
  error_log(print_r(<YOUR_VARIABLE>, true));
  error_log(print_r("✅", true));
*/

function passwordMatch($user, $password) {
  return $user["password"] === $password;
}

function searchForEmail($email) {
  global $db;
  foreach ($db as $usersArrayIndex => $user) {
    if ($user['email'] === $email) {
      return $user;
    }
  }
  return null;
}

function getUserById($id) {
  global $db;
  foreach ($db as $usersArrayIndex => $user) {
    if ($user['id'] === $id) {
      return $user;
    }
  }
  return null;
}

function loginUser($email, $password) {
  $foundUser = searchForEmail($email);
  
  if (!$foundUser) {
    header("location: login.php?error=invalidCredentials");
    exit();
  }

  if (!passwordMatch($foundUser, $password)) {
    header("location: login.php?error=invalidCredentials");
    exit();
  }

  createSessionAndRedirect($foundUser);
}

function emptyLoginFields($email, $password) {

  if(empty($email) || empty($password)) {
    $result= true;
  } else{
    $result=false;
  }
  return $result;
}

function createSessionAndRedirect($foundUser) {
  if(!isset($_SESSION)) 
  { 
      session_start(); 
  }
  $_SESSION["userId"] = $foundUser["id"];
  header("location: ../dashboard/dashboard.php");
  exit();
}