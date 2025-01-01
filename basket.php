<?php
include "db.inc.php";
require_once("./entities/Car.php");
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
                <h1>Basket</h1>
                <section>
                    <h2>Cars in Basket</h2>
                    <table>
                        <tr>
                            <th>
                                Price Per Day
                            </th>
                            <th>Car Make</th>
                            <th>Car Model</th>
                            <th>Car Type</th>
                            <th>Fuel Type</th>
                            <th>Car Photo</th>
                            <th>Rent</th>
                        </tr>
                        <?php
                        if (isset($_SESSION['basket'])) {
                            foreach ($_SESSION['basket'] as $key => $car) {
                                $car->generateCarBasketRow();
                            }
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