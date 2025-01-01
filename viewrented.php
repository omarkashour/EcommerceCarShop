<?php
include "db.inc.php";
require_once("./dbFunctions.php");
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
  <link rel="stylesheet" href="./style.css" />
  <title>Sticky Rentals</title>
</head>

<body>


  <div class="vertical_container">
    <?php include "header.php"; ?>

    <div class="horizontal_container">

      <?php include "navbar.php"; ?>

      <main class="register_main_container">
        <h1>Rented Cars</h1>
        <section>
          <h2>All of Your Past, Current, and Future Rented Cars:</h2>

          <table>
            <tr>
              <th>Invoice ID</th>
              <th>Invoice Date</th>
              <th>Car Type</th>
              <th>Car Model</th>
              <th>Pick-up Date</th>
              <th>Pick-up Location</th>
              <th>Return Date</th>
              <th>Return Location</th>
              <th>Rental Status</th>
            </tr>
            <?php

            if (!isset($_SESSION)) {
              session_start();
            }
            if (!isset($_SESSION['account'])) {
              header("Location: ./login.php");
            }
            $account = $_SESSION['account'];

            $sql = "SELECT * FROM invoice WHERE customer_id = ? ORDER BY invoice_date ASC";
            $statement = $pdo->prepare($sql);
            $statement->bindValue(1, $account->getAccountId());


            $statement->execute();
            $result = $statement->fetchAll();
            foreach ($result as $row) {
              $invoice_id = $row['invoice_id'];
              $account_id = $row['customer_id'];
              $car_id = $row['car_id'];
              $cc_number = $row['cc_number'];
              $holder_name = $row['cc_holder_name'];
              $cc_expiry = $row['cc_expiry'];
              $cvv = $row['cvv'];
              $cc_bank = $row['cc_bank'];
              $cc_type = $row['cc_type'];
              $total_amount = $row['total_amount'];
              $invoice_date = $row['invoice_date'];
              $return_location = $row['return_location'];
              $pickup_location = $row['pickup_location'];
              $invoice = new Invoice($account_id, $car_id, $cc_number, $holder_name, $cc_expiry, $cvv, $cc_bank, $cc_type, $total_amount, $invoice_date, $return_location, $pickup_location);
              $invoice->setInvoiceId($invoice_id);
              $car = $crud->getCar($car_id);
              $invoice->generateInvoiceTableRow($car->getCarType(), $car->getCarModel(), $car->getPickupDate(), $car->getReturnDate());
            }
            ?>

          </table>


        </section>
      </main>
    </div>

    <div class="footer_container">
      <?php include "footer.php"; ?>
    </div>
  </div>



</body>

</html>