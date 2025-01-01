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

      <main class="homepage_main_container">
        <h1>Homepage</h1>

        <section>
          <h2>
            New Arrivals!
          </h2>
          <table>
            <th>
              Price Per Day
            </th>
            <th>Car Make</th>
            <th>Car Model</th>
            <th>Car Type</th>
            <th>Fuel Type</th>
            <th>Car Photo</th>
            <th>Rent</th>
            <?php
                        $sql = "select * from car order by time_added desc";
                        $statement = $pdo->prepare($sql);
                        $statement->execute();
                        $count = 0;
                        $result = $statement->fetchAll();
                        foreach ($result as $row) {
                            if ($count++ == 3)
                                break;
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
                            $pickup_date = $row['pickup_date'];
                            $return_date = $row['return_date'];
                            $pickup_location_id = $row['pickup_location_id'];
                            $photo1 = $row['photo1'];
                            $photo2 = $row['photo2'];
                            $photo3 = $row['photo3'];

                            $car = new Car($car_make, $car_model, $car_type, $color, $reg_year, $description, $price_per_day, $capacity, $fuel_type, $average_consumption, $horse_power, $length, $width, $plate_number, $restrictions, $status, $photo1, $photo2, $photo3, $pickup_date, $return_date, $pickup_location_id);
                            $car->setCarId($car_id);
                            $car->generateCarBasketRow();
                        }

                        ?>
          </table>
        </section>
        <section>
          <h2>Summer Promotion!</h2>
          <?php include("./sale.php"); ?>
        </section>
      </main>

    </div>

    <div class="footer_container">
      <?php include "footer.php"; ?>
    </div>
  </div>



</body>

</html>