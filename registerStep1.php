<?php
include "db.inc.php"; ?>

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
        <h1>Register!</h1>
        <?php

                if (!isset($_SESSION)) {
                    session_start();
                }
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $_SESSION['registration'] = [
                        'name' => $_POST['name'],
                        'address' => $_POST['address'],
                        'dob' => $_POST['dob'],
                        'id_number' => $_POST['id_number'],
                        'email' => $_POST['email'],
                        'phone_number' => $_POST['phone_number'],
                        'cc_number' => $_POST['cc_number'],
                        'cvv' => $_POST['cvv'],
                        'cc_expiry_date' => $_POST['cc_expiry_date'],
                        'holder_name' => $_POST['holder_name'],
                        'cc_bank' => $_POST['cc_bank']
                    ];
                    if (strlen($_POST['cc_number']) != 9) {
                        echo ("<h2 class='error_h2'>Invalid Credit Card Number</h2>");
                    } else if ($_POST['cc_expiry_date'] <= date('Y-m-d')) {
                        echo ("<h2 class='error_h2'>Invalid Credit Card Expiry Date</h2>");
                    } else
                        header('Location: ./registerStep2.php');
                }
                echo '

        <form action="registerStep1.php" method="POST">
          <fieldset>
            <h2>Customer Details:</h2>
            <br>
            <label for="name">Customer Name:</label> <br>
            <input type="text" id="name" name="name" required> <br>

            <label for="address">Address:</label><br>
            <input type="text" id="address" name="address" required> <br>


            <label for="dob">Date of Birth:</label><br>
            <input type="date" id="dob" name="dob" required> <br><br>

            <label for="id_number">ID Number:</label><br>
            <input type="text" id="id_number" name="id_number" required> <br>

            <label for="email">Email Address:</label><br>
            <input type="email" id="email" name="email" required> <br> <br>

            <label for="phone_number">Phone Number:</label><br>
            <input type="text" id="phone_number" name="phone_number" required> <br> <br>
            <h2>Credit Card Details:</h2>
            <br>
            <label for="cc_number">CC Number:</label><br>
            <input type="text" id="cc_number" name="cc_number" required> <br>

            <label for="cvv">CVV:</label><br>
            <input type="text" id="cvv" name="cvv" required> <br>

            <label for="cc_expiry_date">Expiry Date:</label><br>
            <input type="date" id="cc_expiry_date" name="cc_expiry_date" required> <br><br>

            <label for="holder_name">Holder Name:</label><br>
            <input type="text" id="holder_name" name="holder_name" required> <br>

            <label for="cc_bank">Bank:</label><br>
            <input type="text" id="cc_bank" name="cc_bank" required> <br>


            <input type="submit" name="submit" value="Next">
            <label for="submit">(1/3)</label><br>

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