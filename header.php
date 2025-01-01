<?php
require_once("./entities/Account.php");

?>

<header>

    <head>
        <div class="header_container">
            <link rel="stylesheet" href="./style.css">
    </head>
    <figure>
        <a href="./index.php">
            <img alt="logo" width="200" src="./images/stickyrentals.png" />
        </a>
    </figure>
    <a class="title-href" href="./index.php">
        <h1 class="title">Sticky Rentals</h1>
    </a>

    <nav>
        <a href="./index.php">HomePage</a>
        <?php

          if(!isset($_SESSION)) 
          { 
              session_start(); 
          } 
      if(!isset($_SESSION['account'])){
       echo'<a href="./registerStep1.php">Register</a>';
        echo'<a href="./login.php">Login</a>';
      }
      else{
        $account = $_SESSION['account'];
        echo"<a href='./profile.php'>{$account->getName()}, {$account->getUsername()}</a>";
        echo'<a href="./basket.php">Basket</a>';
        echo'<a href="./logout.php">Logout</a>';
      }
    ?>


        <a href="./aboutus.php">About Us </a>
        <?php
      // add register or login or logout
      // add basket
      // add user profile link
  ?>
    </nav>
    </div>
</header>