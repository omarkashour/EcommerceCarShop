<?php
include ("db.inc.php");
include ("dbFunctions.php");
  $crud = new dbFunctions($pdo);
 ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&display=swap"
    rel="stylesheet">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css" />
  <title>Sticky Rentals</title>
</head>

<body>


  <div class="vertical_container">
    <?php include "header.php"; ?>

    <div class="horizontal_container">

      <?php include "navbar.php"; ?>

      <main class="register_main_container">


        <h1>Account Created!</h1>
        <section>
          <?php

if(!isset($_SESSION)) 
{ 
    session_start(); 
} 
        $id = $_SESSION["registration"]["account_id"];
        echo "<p>Your Customer ID is: <strong>{$id}</strong></p>";
        echo"<p>You can login now using the following link:<a href='login.php'>Login</a></p>";
?>

        </section>




      </main>
    </div>

    <div class="footer_container">
      <?php include "footer.php"; ?>
    </div>
  </div>

</body>



</html>