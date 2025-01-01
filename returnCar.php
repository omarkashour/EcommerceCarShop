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
        <h1>Return Car</h1>
        <section>
          <h2>All of Your Current Rented Cars:</h2>
          <?php
          if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])) {
                      if (!isset($_SESSION)) {
              session_start();
            }
            if (!isset($_SESSION['account'])) {
              header("Location: ./login.php");
            }
            $account = $_SESSION['account'];
            $id = $_GET['id'];
            $car = $crud->getCar($id);

            $sql = 'SELECT * FROM car c, invoice i, account a WHERE a.account_id = ? AND a.account_id = i.customer_id AND c.car_id = i.car_id AND c.car_id = ? AND c.status = "rented"';
            $statement = $pdo->prepare($sql);
            $statement->bindValue(1, $account->getAccountId());
            $statement->bindValue(2, $id);
            $statement->execute();
            $result = $statement->fetch();

            if ($result) {
              $return_location = $result['return_location'];

              $sql2 = 'SELECT location_id FROM location l WHERE l.name = ?';
              $statement2 = $pdo->prepare($sql2);
              $statement2->bindValue(1, $return_location);
              $statement2->execute();
              $result2 = $statement2->fetch();

              if ($result2) {
                $return_location_id = $result2['location_id'];

                $car->setPickupLocationId($return_location_id);
                $car->setStatus('returning');

                $crud->updateCar($car);
              }
            }
            unset($_GET['id']);
          }

          ?>

          <table>
            <tr>
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
            $account = $_SESSION['account'];

            $sql = "SELECT * FROM car c, invoice i, account a WHERE a.account_id = ? and a.account_id = i.customer_id and c.car_id = i.car_id and c.status = 'rented'";
            $statement = $pdo->prepare($sql);
            $statement->bindValue(1, $account->getAccountId());
            $statement->execute();
            $result = $statement->fetchAll();
            foreach ($result as $row) {
              $car_id = $row['car_id'];
              $return_location = $row['return_location'];
              $car = $crud->getCar($car_id);
              $car->generateReturnCarRow($return_location);
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