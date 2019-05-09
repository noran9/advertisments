<?php 
session_start();
?>

<html>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" media="screen">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootswatch/4.3.1/lux/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
</head>
<body>

 <nav class="navbar navbar-expand navbar-light bg-light">
    <?php
      $dir = dirname(__FILE__);
      if(isset($_SESSION['user'])){
    ?>
      <div>
        <ul class="navbar-nav mr-auto">
          <li class="nav-item"><a href="index.php">Home</a></li>
          <li class="nav-item"><a href="create.php">Create new advertisment</a></li>
          <li class="nav-item"><a href="my_items.php">My Items</a></li>
          <li class="nav-item"><a href="log_out.php">Log out</a></li>

          <?php if($_SESSION['user'] == 'admin') { ?>
          <li class="nav-item"><a href="index.php?controller=comment&action=all">Comments</a></li>
          <?php } ?> 
        </ul>
      </div>
    <?php } else { ?>
    <div>
      <ul class="navbar-nav mr-auto">
          <li class="nav-item"><a href="index.php">Home</a></li>
          <li class="nav-item"><a href="login.php">Login</a></li>
          <li class="nav-item"><a href="register.php">Register</a></li>
        </ul>
      </div>
    <?php } ?>
</nav>