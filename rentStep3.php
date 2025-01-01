<?php
include "db.inc.php";
require_once("./entities/car.php");
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
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&display=swap" rel="stylesheet">
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
        <h1>Rent Confirmation</h1>
        <section>
          <?php
          if ($_SERVER['REQUEST_METHOD'] = "POST") {
            if (!isset($_SESSION)) {
              session_start();
            }
            if (!isset($_SESSION['total_amount']) || !isset($_SESSION['account'])) {
              header("Location: ./index.php");
            }

            $cc_number = $_POST['cc_number'];
            $cvv = $_POST['cvv'];
            $cc_expiry_date = $_POST['cc_expiry_date'];
            $holder_name = $_POST['holder_name'];
            $cc_bank = $_POST['cc_bank'];
            $card_type = $_POST['card_type'];
            $date = $_POST['date'];
            $total_amount = $_SESSION['total_amount'];
            $car = $_SESSION['car_in_renting_process'];
            $account = $_SESSION['account'];
            $return_location_id = $_SESSION['rent']['special_requirements']['return_location_id'];
            $return_location = $crud->getLocation($return_location_id)->getName();
            $invoice = new Invoice($account->getAccountId(), $car->getCarId(), $cc_number, $holder_name, $cc_expiry_date, $cvv, $cc_bank, $card_type, $total_amount, $date, $return_location, $crud->getLocation($car->getPickupLocationId())->getName());
            $crud->createInvoice($invoice);
            // update database and display success message
            echo "<h2 class='success_h2'>Car has Been Rented Successfully!</h2>";
            echo "<section>
                <h2>Thank You for Renting the Car</h2>
                <p><strong>Your Invoice ID is:</strong> {$invoice->getInvoiceId()}</p>
                </section>";

            $car->setStatus("rented");
            $crud->updateCar($car);
            if (!isset($_SESSION['basket'])) {
              $_SESSION['basket'] = [];
            }
            if (isset($_SESSION['basket'])) {
              foreach ($_SESSION['basket'] as $key => $car) {
                if ($car->getCarId() == $carId) {
                  unset($_SESSION['basket'][$key]);
                  $_SESSION['basket'] = array_values($_SESSION['basket']);
                  break;
                }
              }
            }
          }

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