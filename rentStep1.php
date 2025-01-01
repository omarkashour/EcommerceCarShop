<?php
include "db.inc.php";
require_once("./entities/car.php");
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
        <h1>Rent Car</h1>

        <?php
        if (!isset($_SESSION)) {
          session_start();
        }
        $car = $_SESSION['car_in_renting_process'];


        if (!isset($_SESSION['basket'])) {
          $_SESSION['basket'] = [];
        }
        $contains = false;
        if (isset($_SESSION['basket'])) {
          foreach ($_SESSION['basket'] as $key => $carInBasket) {
            if ($carInBasket->getCarId() == $car->getCarId()) {
              $contains = true;
              break;
            }
          }
        }
        if (!$contains) {
          $_SESSION['basket'][] = $car;
        }
        $returnDate = new DateTime($car->getReturnDate());
        $pickupDate = new DateTime($car->getPickupDate());

        // calculate the difference in days
        $dateDiff = $returnDate->diff($pickupDate);
        $daysDifference = $dateDiff->days;
        $total_amount = $car->getPricePerDay() * ($daysDifference);
        echo "
        <form action='./rentStep2.php' method='POST'>
          <fieldset>
            <h2>Car Details:</h2>
            <label for='car_id'>Car ID:</label> <br>
            <input type='text' readonly name='car_id' value='{$car->getCarId()}'> <br>

            <label for='car_model'>Car Model:</label> <br>
            <input type='text' readonly name='car_model' value='{$car->getCarModel()}'> <br>

            <label for='description'>Car Description:</label> <br>
            <input type='text' readonly name='description' value='{$car->getDescription()}'> <br>

            <label for='pick_up_date'>Pickup Date:</label> <br>
            <input type='date' readonly name='pick_up_date' value='{$car->getPickupDate()}'> <br>

            <label for='return_date'>Return Date:</label> <br>
            <input readonly type='date' name='return_date' value='{$car->getReturnDate()}'> <br>

            <label for='total_rent_amount'>Total Rent Amount ({$daysDifference} days):</label> <br>
            <input type='number' readonly name='total_rent_amount' value='{$total_amount}'> <br> "; ?>

        <h2>Special Requirements (Extra Cost):</h2>
        <label for="return_location_id">($70) Return Location:</label> <br>
        <select id="return_location_id" name="return_location_id"><br>
          <?php

          $sql = "select * from location";
          $statement = $pdo->prepare($sql);
          $statement->execute();
          $result = $statement->fetchAll();
          foreach ($result as $row) {
            $location_id = $row['location_id'];
            $name = $row['name'];
            if ($name == "Birzeit") {
              echo " <option selected value='{$location_id}'>{$name}</option>";
            } else
              echo " <option value='{$location_id}'>{$name}</option>";
          }
          ?>
        </select> <br> <br>

        <input type="checkbox" id="baby_seats" name="options[]" value="baby_seats">
        <label for="baby_seats">($50) Baby Seats</label>
        <br>

        <input type="checkbox" id="insurance" name="options[]" value="insurance">
        <label for="insurance">($150) Insurance</label>

        <br> <br>

        <input type="submit" name="submit" value="Next">
        <label for="submit">(1/3)</label>

        </fieldset>
        </form>";

      </main>

    </div>

    <div class="footer_container">
      <?php include "footer.php"; ?>
    </div>
  </div>



</body>

</html>