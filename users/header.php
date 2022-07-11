<?php
if(!isset($_SESSION)) 
{ 
    session_start(); 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/daisyui@2.17.0/dist/full.css" rel="stylesheet" type="text/css" />
  <script src="https://cdn.tailwindcss.com"></script>
  <title>My Site</title>
</head>
<body>

<div class="navbar bg-base-100">
  <div class="navbar-start">
    <div class="dropdown">
      <label tabindex="0" class="btn btn-ghost lg:hidden">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h8m-8 6h16" /></svg>
      </label>
      <ul tabindex="0" class="menu menu-compact dropdown-content mt-3 p-2 shadow bg-base-100 rounded-box w-52">
        <li><a>Sign Up</a></li>
        <li><a>About Us</a></li>
      </ul>
    </div>
    <a href="/" class="btn btn-ghost normal-case text-xl">Course Manager✏️</a>
  </div>
  <div class="navbar-center hidden lg:flex">
    <ul class="menu menu-horizontal p-0">
      <li><a>Sign Up</a></li>
      <li><a>About Us</a></li>
    </ul>
  </div>
  <div class="navbar-end">
    <?php 
      if(isset($_SESSION["userId"])) {
        echo '<a href="/pages/login/logout.php" class="btn btn-primary">Logout</a>';
      } else {
        echo '<a href="/pages/login/login.php" class="btn btn-primary">Login</a>';
      }
    ?>
  </div>
</div>

  <div class="wrapper">
