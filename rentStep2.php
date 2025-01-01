<?php
include "db.inc.php"; 
require_once("./entities/Car.php");
require_once("./entities/Account.php");
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
        <h1>Rent Invoice</h1>
        <?php
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
              if(!isset($_SESSION)) 
              { 
                  session_start(); 
              } 
              $_SESSION['return_location_id'] = $_POST['return_location_id'];
                  $_SESSION['rent']['special_requirements'] = [];
                  $originalCost = (int)$_POST['total_rent_amount'];
                  $extra_amount = 0;
                  if (isset($_POST['return_location_id'])) {
                      $return_location_id = $_POST['return_location_id'];
                      $_SESSION['rent']['special_requirements']['return_location_id'] = $return_location_id;
                      if($crud->getLocation($return_location_id)->getName() != "Birzeit")
                       $extra_amount += 70;
                  }
                  if (isset($_POST['options']) && in_array('baby_seats', $_POST['options'])) {
                      $_SESSION['rent']['special_requirements']['baby_seats'] = true;
                      $extra_amount += 50;
                  } else {
                      $_SESSION['rent']['special_requirements']['baby_seats'] = false;
                  }
                  if (isset($_POST['options']) && in_array('insurance', $_POST['options'])) {
                      $_SESSION['rent']['special_requirements']['insurance'] = true;
                      $extra_amount += 150;

                  } else {
                      $_SESSION['rent']['special_requirements']['insurance'] = false;
                  }
                  $_SESSION['total_amount'] = $originalCost + $extra_amount;


            }

            function formatDateTime($date, $time) {
              return date('M j, Y', strtotime($date)) . ' at ' . date('h:i A', strtotime($time));
          }
                    function formatMoney($amount) {
              return '$' . number_format($amount, 2);
          }
          ?>
        <section>
          <div class="invoice-header">
          </div>
          <div class="invoice-details">
            <h2>Invoice Date: <?php echo date('Y-m-d H:i:s') ; ?></h2>
            <h2>Customer ID: <?php $account =  $_SESSION['account']; echo  $account->getAccountId(); ?></h2>
            <h2>Customer Name: <?php echo  $account->getName(); ?></h2>
            <h2>Customer Address: <?php echo $account->getAddress(); ?></h2>
            <h2>Customer Telephone: <?php echo $account->getPhoneNumber(); ?></h2>
          </div>
          <table class="invoice-table">
            <thead>
              <tr>
                <th>Description</th>
                <th>Details</th>
                <th>Extra Cost</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td><strong>Car Model</strong></td>
                <td><?php echo $_SESSION['car_in_renting_process']->getCarModel(); ?></td>
                <td>-</td>

              </tr>
              <tr>
                <td><strong>Car Type</strong></td>
                <td><?php echo $_SESSION['car_in_renting_process']->getCarType(); ?></td>
                <td>-</td>

              </tr>
              <tr>
                <td><strong>Fuel Type</strong></td>
                <td><?php echo $_SESSION['car_in_renting_process']->getFuelType(); ?></td>
                <td>-</td>

              </tr>
              <tr>
                <td><strong>Pickup Date & Time</strong></td>
                <td>
                  <?php echo $_SESSION['car_in_renting_process']->getPickupDate(); ?>
                </td>
                <td>-</td>
              </tr>
              <tr>
                <td><strong>Pickup Location</strong></td>
                <td>
                  <?php echo $crud->getLocation($_SESSION['car_in_renting_process']->getPickupLocationId())->getName(); ?>
                </td>
                <td>-</td>


              </tr>
              <tr>
                <td><strong>Return Date & Time</strong></td>
                <td>
                  <?php echo $_SESSION['car_in_renting_process']->getReturnDate(); ?>
                </td>
                <td>-</td>

              </tr>
              <tr>
                <td><strong>Return Location</strong></td>
                <td>
                  <?php echo $crud->getLocation($_SESSION['return_location_id'])->getName(); ?>
                </td>
                <?php if($crud->getLocation($_SESSION['car_in_renting_process']->getPickupLocationId())->getName() !="Birzeit"){
                    echo '<td>$70</td>';
                }
                ?>
              </tr>
              <tr>
                <td><strong>Additional Requirements</strong></td>
                <td>
                  <?php
                        $requirements = [];
                        if ($_SESSION['rent']['special_requirements']['insurance']) {
                            $requirements[] = 'Insurance';
                        }
                        if ($_SESSION['rent']['special_requirements']['baby_seats']) {
                            $requirements[] = 'Baby Seats';
                        }
                        echo implode(', ', $requirements);
                        ?>
                </td>
                <td>
                  <?php 
                   $extra = " ";
                        $requirements = [];
                        if ($_SESSION['rent']['special_requirements']['insurance']) {
                            $extra .= "\$150 +";
                        }
                        if ($_SESSION['rent']['special_requirements']['baby_seats']) {
                            $extra .= " \$70";
                        }
                        echo $extra;
                        ?>
                </td>

              </tr>
            </tbody>
          </table>
          <div class="invoice-total">
            <p><strong>Total Amount:</strong>
              <?php echo formatMoney($originalCost) . " + " . formatMoney($extra_amount) ." = " .  formatMoney($originalCost+$extra_amount); ?>
            </p>
          </div>
        </section>

        <form action="./rentStep3.php" method="POST">
          <fieldset>
            <h2>Credit Card Details:</h2>
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
            <label for="card_type">Card Type:</label><br>
            <input type="radio" id="visa" name="card_type" value="visa" required>
            <label for="visa">Visa</label><br>

            <input type="radio" id="mastercard" name="card_type" value="mastercard" required>
            <label for="mastercard">MasterCard</label><br>

            <input type="radio" id="amex" name="card_type" value="amex" required>
            <label for="amex">American Express</label><br>

            <input type="radio" id="discover" name="card_type" value="discover" required>
            <label for="discover">Discover</label><br><br>



            <label for="name">Your Name:</label><br>
            <input type="text" id="name" name="name" required> <br>

            <label for="date">Date:</label><br>
            <input type="date" id="date" name="date" required> <br><br>

            <input required type="checkbox" id="terms" name="terms" required>
            <label for="terms">I accept the contract terms and conditions</label><br><br>


            <input type="submit" name="submit" value="Next">
            <label for="submit">(2/3)</label><br>

          </fieldset>

        </form>
      </main>
    </div>

    <div class="footer_container">
      <?php include "footer.php"; ?>
    </div>
  </div>



</body>

</html>