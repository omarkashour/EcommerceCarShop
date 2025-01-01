<?php
include "db.inc.php";
require_once("./entities/Car.php");
require_once("./dbFunctions.php");
$crud = new dbFunctions($pdo);
if (!isset($_SESSION)) {
  session_start();
}
$cars = isset($_SESSION['cars']) ? $_SESSION['cars'] : array();

$sort_field = 'price_per_day';

if (!isset($_COOKIE['sort_field'])) {
  setcookie('sort_field', $sort_field, time() + (86400 * 30));
} elseif (isset($_COOKIE['sort_field'])) {
  $sort_field = $_COOKIE['sort_field'];
}

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
  if (isset($_GET['sort'])) {
    $sort_field = $_GET['sort'];
    setcookie('sort_field', $sort_field, time() + (86400 * 30));
  } elseif (isset($_COOKIE['sort_field'])) {
    $sort_field = $_COOKIE['sort_field'];
  }
}
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

      <main class="search_main_container">
        <h1>Search Cars</h1>

        <form action="search.php" method="POST">

          <fieldset>
            <h2>Search Filters:</h2>
            <label for="start_date">Renting Period:</label>
            <input type="date" id="start_date" name="start_date" value="<?php echo date('Y-m-d'); ?>" required>
            <p>To</p>
            <input type="date" id="end_date" name="end_date" value="<?php echo date('Y-m-d', strtotime('+3 days')); ?>" required><br>
            <label for="car_type">Car Type:</label>
            <select required id="car_type" name="car_type">
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
            <select required id="pickup_location_id" name="pickup_location_id">
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
            </select><br><br>

            <label for="min_price">Price Range:</label>
            <input type="number" id="min_price" name="min_price" value="200" required>
            <p>To</p>
            <input type="number" id="max_price" name="max_price" value="1000" required><br><br>


            <button type="submit" class="btn">Search</button>



          </fieldset>

          <table>
            <tr>
              <th>
                <button type="submit" value="Short List" name="short_list">Short
                  List</button>
              </th>
              <th>
                <a href="./search.php?sort=price_per_day">
                  Price Per Day
                </a>
              </th>
              <th> <a href="./search.php?sort=car_type">Car Type</a></th>
              <th><a href="./search.php?sort=fuel_type">Fuel Type</a></th>
              <th>Car Photo</th>
              <th>Rent</th>
            </tr>
            <?php
            if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['sort'])) { // handle the sorting
              if (isset($_SESSION['cars']) && !empty($_SESSION['cars'])) {
                $sql = "SELECT * FROM car  ORDER BY {$sort_field} ASC";
                $statement = $pdo->prepare($sql);
                $statement->execute();
                $result = $statement->fetchAll();
                foreach ($result as $row) {
                  $car_id = $row['car_id'];
                  if (in_array($car_id, $_SESSION['cars'])) {
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
                    $photo1 = $row['photo1'];
                    $photo2 = $row['photo2'];
                    $photo3 = $row['photo3'];
                    $pickup_date = $row['pickup_date'];
                    $return_date = $row['return_date'];
                    $pickup_location_id = $row['pickup_location_id'];

                    $car = new Car($car_make, $car_model, $car_type, $color, $reg_year, $description, $price_per_day, $capacity, $fuel_type, $average_consumption, $horse_power, $length, $width, $plate_number, $restrictions, $status, $photo1, $photo2, $photo3, $pickup_date, $return_date, $pickup_location_id);
                    $car->setCarId($car_id);
                    $car->generateCarRow();
                  }
                }
              }
            }


            if ($_SERVER['REQUEST_METHOD'] == "POST") {
              if (isset($_POST['short_list']) && isset($_POST['car_id']) && is_array($_POST['car_id'])) {
                $shortlist = $_POST['car_id'];
                $cars = array();
                foreach ($shortlist as $car_id) {
                  $car = $crud->getCar($car_id);
                  $cars[] = (int)$car->getCarId();
                  $car->generateCarRow();
                }
                $_SESSION['cars'] = $cars;
              } else {
                $cars = array();

                $start_date = $_POST['start_date'];
                $end_date = $_POST['end_date'];
                $car_type = $_POST['car_type'];
                $pickup_location_id = $_POST['pickup_location_id'];
                $min_price = $_POST['min_price'];
                $max_price = $_POST['max_price'];


                $sql = "select * from car c where c.pickup_date <= ? and c.return_date >= ? and c.car_type = ? and c.pickup_location_id = ? and c.price_per_day >= ? and c.price_per_day <= ? and c.status = 'available' order by {$sort_field} asc";
                $statement = $pdo->prepare($sql);
                $statement->bindValue(1, $start_date);
                $statement->bindValue(2, $end_date);
                $statement->bindValue(3, $car_type);
                $statement->bindValue(4, $pickup_location_id);
                $statement->bindValue(5, $min_price);
                $statement->bindValue(6, $max_price);

                $statement->execute();
                $result = $statement->fetchAll();
                foreach ($result as $row) {
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
                  $photo1 = $row['photo1'];
                  $photo2 = $row['photo2'];
                  $photo3 = $row['photo3'];
                  $pickup_date = ['pickup_date'];
                  $return_date = $row['return_date'];
                  $pickup_location_id = $row['pickup_location_id'];
                  $car = new Car($car_make, $car_model, $car_type, $color, $reg_year, $description, $price_per_day, $capacity, $fuel_type, $average_consumption, $horse_power, $length, $width, $plate_number, $restrictions, $status, $photo1, $photo2, $photo3, $pickup_date, $return_date, $pickup_location_id);
                  $car->setCarId($car_id);
                  $cars[] = (int)$car->getCarId();
                  $car->generateCarRow();
                }
                $_SESSION['cars'] = $cars;
              }
            }

            ?>

          </table>
        </form>

    </div>

    </main>
  </div>

  <div class="footer_container">
    <?php include "footer.php"; ?>
  </div>
  </div>



</body>

</html>