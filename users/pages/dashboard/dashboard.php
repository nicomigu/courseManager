<?php
require_once("../login/useAuth.php");

$user = getLoggedInUser();
// Restricted route
if(!$user) {
  header("location: ../login/login.php");
  exit();
}

require("dashboard.view.php");