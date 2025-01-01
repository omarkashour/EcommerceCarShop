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
        <h1>Return Car</h1>
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])) {
          $car = $crud->getCar($_GET['id']);

          echo "<form action='./returnCarManager.php' method='POST'>";
          echo "<fieldset>";
          echo "
          
                    <label for='car_id'>Car ID:</label><br>
<input readonly type='text' id='car_id' name='car_id' value='{$car->getCarId()}'><br>

          <label for='car_make'>Car Make:</label><br>
<select readonly id='car_make' name='car_make'>
    <option selected value='{$car->getCarMake()}'>{$car->getCarMake()}</option>
</select><br><br>

<label for='car_model'>Car Model:</label><br>
<input readonly type='text' id='car_model' name='car_model' value='{$car->getCarModel()}'><br><br>

<label for='car_type'>Car Type:</label><br>
<select readonly id='car_type' name='car_type'>
    <option selected value='{$car->getCarType()}'>{$car->getCarType()}</option>
</select><br><br>

<label for='reg_year'>Registration Year:</label><br>
<input readonly type='text' id='reg_year' name='reg_year' value='{$car->getRegYear()}'><br><br>

<label for='description'>Description:</label><br>
<textarea readonly id='description' name='description'>{$car->getDescription()}</textarea><br><br>

<label for='price_per_day'>Price Per Day:</label><br>
<input readonly type='text' id='price_per_day' name='price_per_day' value='{$car->getPricePerDay()}'><br><br>

<label for='capacity'>Capacity:</label><br>
<input readonly type='text' id='capacity' name='capacity' value='{$car->getCapacity()}'><br><br>

<label for='colors'>Color:</label><br>
<input readonly type='text' id='color' name='color' value='{$car->getColor()}'><br><br>

<label for='fuel_type'>Fuel Type:</label><br>
<select readonly id='fuel_type' name='fuel_type'>
    <option selected value='{$car->getFuelType()}'>{$car->getFuelType()}</option>
</select><br><br>

<label for='average_consumption'>Average Consumption per 100 kilometers:</label><br>
<input  readonly type='text' id='average_consumption' name='average_consumption' value='{$car->getAverageConsumption()}'><br><br>

<label for='horse_power'>Horse Power:</label><br>
<input readonly type='text' id='horse_power' name='horse_power' value='{$car->getHorsePower()}'><br><br>

<label for='length'>Length (m):</label><br>
<input readonly type='text' id='length' name='length' value='{$car->getLength()}'><br><br>

<label for='width'>Width (m):</label><br>
<input readonly type='text' id='width' name='width' value='{$car->getWidth()}'><br><br>

<label for='plate_number'>Plate Number:</label><br>
<input readonly type='text' id='plate_number' name='plate_number' value='{$car->getPlateNumber()}'><br><br>

<label for='restrictions'>Conditions or Restrictions:</label><br>
<textarea readonly id='restrictions' name='restrictions' value='{$car->getRestrictions()}'></textarea><br><br>

<label for='status'>Status:</label><br>
<select required id='status' name='status'>
    <option value='available' selected>Available</option>
    <option value='damaged'>Damaged</option>
    <option value='repair'>Repair</option>
</select><br><br>

        <label for='pickup_location_id'>Pickup Location:</label><br>
        <select required id='pickup_location_id' name='pickup_location_id'>";
          $sql = "select * from location";
          $statement = $pdo->prepare($sql);
          $statement->execute();
          $result = $statement->fetchAll();
          foreach ($result as $row) {
            $location_id = $row['location_id'];
            $name = $row['name'];
            if ($location_id == $car->getPickupLocationId()) {
              echo " <option selected value='{$location_id}'>{$name}</option>";
            }
            echo " <option value='{$location_id}'>{$name}</option>";
          }
          echo "</select><br><br>";
          echo "<input type='submit' value='submit'>";
          echo "</fieldset>";
          echo "</form>";
        } else if ($_SERVER['REQUEST_METHOD'] == "POST") {
          $car_id = $_POST['car_id'];
          $car = $crud->getCar($car_id);
          $car->setPickupLocationId($_POST['pickup_location_id']);
          $car->setStatus($_POST['status']);
          $crud->updateCar($car);
          header("Location: ./returnCarManager.php");
        }
        ?>
        <section>
          <h2>All of the Returning Cars:</h2>


          <table>
            <tr>
              <th>Customer Name</th>
              <th>Car ID</th>
              <th>Car Make</th>
              <th>Car Type</th>
              <th>Car Model</th>
              <th>Pick-up Date</th>
              <th>Return Date</th>
              <th>Return Location</th>
              <th>Action</th>
            </tr>
            <?php

            if (!isset($_SESSION)) {
              session_start();
            }
            if (!isset($_SESSION['account'])) {
              header("Location: ./login.php");
            }

            $sql = "SELECT * FROM car c, invoice i, account a WHERE a.account_id = i.customer_id and c.car_id = i.car_id and c.status = 'returning'";
            $statement = $pdo->prepare($sql);
            $statement->execute();
            $result = $statement->fetchAll();
            foreach ($result as $row) {
              $car_id = $row['car_id'];
              $return_location = $row['return_location'];
              $car = $crud->getCar($car_id);
              $customer_name = $row['name'];
              $car->generateReturnCarManagerRow($customer_name, $return_location);
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