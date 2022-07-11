<?php
require_once("useAuth.php");

// ❌ Don't let the user access login page if they're already logged in
$user = getLoggedInUser();
if($user) {
  header("location: ../dashboard/dashboard.php");
  exit();
}

$errors = "";
if (isset($_GET["error"]) && $_GET["error"] == "invalidCredentials") {
    $errors = '<span class="text-xs tracking-wide text-red-600">Invalid Credentials </span>';
} else if (isset($_GET["error"])  && $_GET["error"] == "emptyFields") {
    $errors = '<span class="text-xs tracking-wide text-red-600">Email or Password cannot be blank</span>';;
}

require("login.view.php");