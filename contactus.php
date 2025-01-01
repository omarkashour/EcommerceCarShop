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
                <h1>Contact Us</h1>
                <form>
                    <fieldset>
                        <h2>Contact Form:</h2>
                        <label for="senderName">Sender Name:</label><br>
                        <input type="text" name="senderName" id="senderName" required><br>
                        <label for="senderEmail">Sender Email:</label><br>
                        <input type="email" name="senderEmail" id="senderEmail" required><br>
                        <label for="senderLocation">Sender Location (city):</label><br>
                        <input type="text" name="senderLocation" id="senderLocation" required><br>
                        <label for="messageSubject">Message Subject:</label><br>
                        <input type="text" name="messageSubject" id="messageSubject" required><br>
                        <label for="messageBody">Message Body:</label><br>
                        <textarea id="messageBody" name="messageBody" rows="4" required></textarea><br>
                        <button type="submit">Send</button>
                        <button type="reset">Reset</button>
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