<?php
include_once "loginHelpers.php";

function getLoggedInUser() {
  if(!isset($_SESSION)) 
  { 
      session_start(); 
  }
  if(isset($_SESSION["userId"])) {
    return getUserById($_SESSION["userId"]);
  } else {
   return null; 
  }
}