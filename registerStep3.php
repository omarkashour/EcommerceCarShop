<?php
include("db.inc.php");
include("dbFunctions.php");
$crud = new dbFunctions($pdo);
?>
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
        <?php

        if (!isset($_SESSION)) {
          session_start();
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') { // enter after user confirm data

          $account_type = "Customer";
          $id_number = $_SESSION['registration']['id_number'];
          $name = $_SESSION['registration']['name'];
          $address = $_SESSION['registration']['address'];
          $dob = $_SESSION['registration']['dob'];
          $email = $_SESSION['registration']['email'];
          $phone_number = $_SESSION['registration']['phone_number'];
          $username = $_SESSION['registration']['username'];
          $password = $_SESSION['registration']['password'];
          $cc_number = $_SESSION['registration']['cc_number'];
          $ccv = $_SESSION['registration']['cvv'];
          $cc_expiry_date = $_SESSION['registration']['cc_expiry_date'];
          $holder_name = $_SESSION['registration']['holder_name'];
          $cc_bank = $_SESSION['registration']['cc_bank'];
          $cc_type = "Visa";
          $account = new Account(
            $account_type,
            $id_number,
            $name,
            $address,
            $dob,
            $email,
            $phone_number,
            $username,
            $password,
            $cc_number,
            $ccv,
            $cc_expiry_date,
            $holder_name,
            $cc_bank,
            $cc_type
          );

          $crud->createAccount($account);
          echo $account->getAccountId();
          $_SESSION['registration']['account_id'] = $account->getAccountId();
          header('Location: confirmation.php');
        }

        ?>

        <h1>Confirmation</h1>
        <form action="registerStep3.php" method="POST">
          <section>
            <?php
            $account_type = "Customer";
            $id_number = $_SESSION['registration']['id_number'];
            $name = $_SESSION['registration']['name'];
            $address = $_SESSION['registration']['address'];
            $dob = $_SESSION['registration']['dob'];
            $email = $_SESSION['registration']['email'];
            $phone_number = $_SESSION['registration']['phone_number'];
            $username = $_SESSION['registration']['username'];
            $password = $_SESSION['registration']['password'];
            $cc_number = $_SESSION['registration']['cc_number'];
            $ccv = $_SESSION['registration']['cvv'];
            $cc_expiry_date = $_SESSION['registration']['cc_expiry_date'];
            $holder_name = $_SESSION['registration']['holder_name'];
            $cc_bank = $_SESSION['registration']['cc_bank'];
            $cc_type = "Visa";

            echo "<p>ID Number: {$id_number}</p>";
            echo "<p>Name: {$name}</p>";
            echo "<p>Address: {$address}</p>";
            echo "<p>Date of Birth: {$dob}</p>";
            echo "<p>Email: {$email}</p>";
            echo "<p>Phone Number: {$phone_number}</p>";
            echo "<p>Username: {$username}</p>";
            echo "<p>Credit Card Number: {$cc_number}</p>";
            echo "<p>CVV: {$ccv}</p>";
            echo "<p>Credit Card Expiry Date: {$cc_expiry_date}</p>";
            echo "<p>Card Holder Name: {$holder_name}</p>";
            echo "<p>Credit Card Bank: {$cc_bank}</p>";
            echo "<p>Credit Card Type: {$cc_type}</p>";
            ?>


            <input type="submit" value="Confirm">
            <label for="submit">(3/3)</label>
          </section>


        </form>



      </main>
    </div>

    <div class="footer_container">
      <?php include "footer.php"; ?>
    </div>
  </div>

</body>



</html>