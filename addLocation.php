<?php
include "db.inc.php"; 
require_once("./dbFunctions.php");
require_once("./entities/Location.php");
$crud = new dbFunctions($pdo);
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

            <main class="addLocation_main_container">
                <h1>Add Location</h1>

                <?php
                    if($_SERVER['REQUEST_METHOD'] == "POST"){
                        $name = $_POST['name'];
                        $address = $_POST['address'];
                        $phone = $_POST['phone'];

                        $location = new Location($name,$address,$phone);
                        $crud->createLocation($location);
                        echo '<h2 class="success_h2">Location Added Sucessfully!';
                    }
                ?>
                <form action="addLocation.php" method="POST">
                    <fieldset>
                        <h2>Location Details:</h2>
                        <label for="name">Name:</label><br>
                        <input required type="text" name="name"> <br>

                        <label for="address">Address:</label> <br>
                        <input required type="text" name="address"> <br>

                        <label for="phone">Phone:</label> <br>
                        <input required type="text" name="phone"> <br>


                        <input type="submit" name="submit" value="Submit">
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