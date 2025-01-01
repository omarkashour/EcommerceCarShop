<?php
include "db.inc.php"; 
require_once("./entities/car.php");
require_once("./dbFunctions.php");
$crud = new dbFunctions($pdo);
?>


<?php

if(!isset($_SESSION)) 
{ 
    session_start(); 
} 

if(!isset($_SESSION['account'])){
  

    $_SESSION['redirect'] = true;
    // check if HTTPS is on to construct the URL correctly
    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
    
    // get the host (domain name)
    $host = $_SERVER['HTTP_HOST'];
    
    // get the current request URI, including any GET parameters
    $uri = $_SERVER['REQUEST_URI'];
    
    // combine them to form the full URL
    $currentURL = $protocol . "://" . $host . $uri;
    $_SESSION['redirect_original_url'] = $currentURL;
    header("Location: ./login.php");
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

      <main class="register_main_container">
        <h1>Car Details</h1>
        <?php

                        if($_SERVER['REQUEST_METHOD'] == 'GET'){
                            $car_id = $_GET['id'];
                            $car = $crud->getCar($car_id);
                            if(!isset($_SESSION)) { 
                                    session_start(); 
                            } 
                            $_SESSION['car_in_renting_process'] = $car;
                            $car->displayCarDetails();

                        }
                    ?>


      </main>

    </div>

    <div class="footer_container">
      <?php include "footer.php"; ?>
    </div>
  </div>



</body>

</html>