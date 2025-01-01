<?php
include "db.inc.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&display=swap" rel="stylesheet">
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
        <h1>E-Account</h1>

        <?php


        if (!isset($_SESSION)) {
          session_start();
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
          if ($_POST['password'] != $_POST['confirm_password']) {
            echo '<h2 class="error_h2">Passwords do not match!</h2>';
          } else {

            $_SESSION['registration']['username'] = $_POST['username'];
            $_SESSION['registration']['password'] = $_POST['password'];

            if (strlen($_POST['password']) < 8 || strlen($_POST['password']) > 12) {
              echo '<h2 class="error_h2">Passwords can Only be Between 8 and 12 Characters in Length</h2>';
            } else
              header('Location: registerStep3.php');
          }
        }

        echo '
        <form action="registerStep2.php" method="POST">
          <fieldset>
            <h2>E-Account Details:</h2>
            <br>
            <label for="username">Username:</label> <br>
            <input type="text" id="username" name="username" required> <br>

            <label for="password">Password:</label><br>
            <input type="password" id="password" name="password" required> <br><br>


            <label for="confirm_password">Confirm Password:</label><br>
            <input type="password" id="confirm_password" name="confirm_password" required> <br><br>

            <input type="submit" name="submit" value="Next">
             <label for="submit">(2/3)</label><br>
          </fieldset>

        </form>
        ';

        ?>
      </main>
    </div>

    <div class="footer_container">
      <?php include "footer.php"; ?>
    </div>
  </div>

</body>



</html>