<?php
include "db.inc.php"; 
require_once("./entities/Account.php");
require_once("./entities/Car.php");

?>

<?php

if(!isset($_SESSION)) 
{ 
    session_start(); 
} 

if(!isset($_SESSION['account']) || (isset($_SESSION['account']) && $_SESSION['account']->getAccountType() != "Manager")){
  
header("Location: forbidden.html");
}
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

            <main class="search_main_container">
                <h1>Car Inquire</h1>

                <form action="carInquire.php" method="POST">

                    <fieldset>
                        <h2>Search Filters:</h2>
                        <label for="start_date">Renting Period:</label>
                        <input required type="date" id="start_date" name="start_date"
                            value="<?php echo date('Y-m-d'); ?>">
                        <p>To</p>
                        <input type="date" id="end_date" name="end_date"
                            value="<?php echo date('Y-m-d', strtotime('+7 days')); ?>" required><br>
                        <label for="car_type">Car Type:</label>
                        <select id="car_type" name="car_type">
                            <option value="">Select a Car Type</option>
                            <option value="Convertible">Convertible</option>
                            <option value="Coupe">Coupe</option>
                            <option value="Hatchback">Hatchback</option>
                            <option value="Minivan">Minivan</option>
                            <option value="Pickup Truck">Pickup Truck</option>
                            <option value="Sedan">Sedan</option>
                            <option value="SUV">SUV</option>
                            <option value="Truck">Truck</option>
                            <option value="Wagon">Wagon</option>
                        </select><br><br>

                        <label for="pickup_location_id">Pick-up Location:</label>
                        <select id="pickup_location_id" name="pickup_location_id">

                            <?php
                            echo " <option value=''>Select a Location</option>";

                                  $sql = "select * from location";
                                  $statement = $pdo->prepare($sql);
                                  $statement->execute();
                                  $result = $statement->fetchAll();
                                  foreach($result as $row){
                                      $location_id = $row['location_id'];
                                      $name = $row['name'];
                                      echo " <option value='{$location_id}'>{$name}</option>";

                                  }
?>
                        </select><br><br>

                        <label for="min_price">Price Range:</label>
                        <input type="number" id="min_price" name="min_price">
                        <p>To</p>
                        <input type="number" id="max_price" name="max_price"><br><br>


                        <button type="submit" class="btn">Search</button>

                    </fieldset>
                </form>



                <table>
                    <tr>
                        <th>Car ID</th>
                        <th>Car Type</th>
                        <th>Car Model</th>
                        <th>Description</th>
                        <th>Car Photo</th>
                        <th>Fuel Type</th>
                        <th>Status</th>
                    </tr>
                    <?php


if($_SERVER['REQUEST_METHOD'] == "POST"){
  
  $start_date = $_POST['start_date'];
  $end_date = $_POST['end_date'];
  $car_type = $_POST['car_type'];
  $pickup_location_id = $_POST['pickup_location_id'];
  $min_price = $_POST['min_price'];
  $max_price = $_POST['max_price'];

  
  $sql = "select * from car c where c.pickup_date <= ? and c.return_date >= ?";
if ($car_type) {
    $sql .= " AND c.car_type = ?";
}
if ($pickup_location_id) {
    $sql .= " AND c.pickup_location_id = ?";
}

if ($min_price) {
    $sql .= " AND c.price_per_day >= ?";
}

if ($max_price) {
    $sql .= " AND c.price_per_day <= ?";
}
  $statement = $pdo->prepare($sql);
  $statement->bindValue(1,$start_date);
  $statement->bindValue(2,$end_date);
  $paramIndex = 3;
  if ($car_type) {
      $statement->bindValue($paramIndex++, $car_type);
  }
  if ($pickup_location_id) {
      $statement->bindValue($paramIndex++, $pickup_location_id);
  }

  if ($min_price) {
    $statement->bindValue($paramIndex++, $min_price);
}

if ($max_price) {
    $statement->bindValue($paramIndex++, $max_price);
}


  $statement->execute();
  $result = $statement->fetchAll();
  foreach($result as $row){
    $car_id = $row['car_id'];
    $car_make = $row['car_make'];
    $car_model = $row['car_model'];
    $car_type = $row['car_type'];
    $color = $row['color'];
    $reg_year = $row['reg_year'];
    $description = $row['description'];
    $price_per_day = $row['price_per_day'];
    $capacity = $row['capacity'];
    $fuel_type = $row['fuel_type'];
    $average_consumption = $row['average_consumption'];
    $horse_power = $row['horse_power'];
    $length = $row['length'];
    $width = $row['width'];
    $plate_number = $row['plate_number'];
    $restrictions = $row['restrictions'];
    $status = $row['status'];
    $photo1= $row['photo1'];
    $photo2= $row['photo2'];
    $photo3= $row['photo3'];
    $pickup_date = ['pickup_date'];
    $return_date = $row['return_date'];
    $pickup_location_id = $row['pickup_location_id'];
    $car = new Car($car_make,$car_model, $car_type,$color, $reg_year, $description, $price_per_day, $capacity, $fuel_type, $average_consumption, $horse_power, $length, $width, $plate_number, $restrictions, $status,$photo1,$photo2,$photo3,$pickup_date,$return_date,$pickup_location_id);
    $car->setCarId($car_id);
    $car->generateManagerCarRow();
  }
  }
?>

                </table>

        </div>

        </main>
    </div>

    <div class="footer_container">
        <?php include "footer.php"; ?>
    </div>
    </div>



</body>

</html>