<?php
include "db.inc.php";
include ("dbFunctions.php");
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

            <main class="addCar_main_container">
                <h1>Add Car</h1>

                <?php
          if($_SERVER['REQUEST_METHOD'] == "POST"){
            $car_make = $_POST['car_make'];
            $car_model = $_POST['car_model'];
            $car_type = $_POST['car_type'];
            $color = $_POST['color'];
            $reg_year = $_POST['reg_year'];
            $description = $_POST['description'];
            $price_per_day = $_POST['price_per_day'];
            $capacity = $_POST['capacity'];
            $fuel_type = $_POST['fuel_type'];
            $average_consumption = $_POST['average_consumption'];
            $horse_power = $_POST['horse_power'];
            $length = $_POST['length'];
            $width = $_POST['width'];
            $plate_number = $_POST['plate_number'];
            $restrictions = $_POST['restrictions'];
            $status = $_POST['status'];
            $pickup_date = $_POST['pickup_date'];
            $return_date = $_POST['return_date'];
            $pickup_location_id = $_POST['pickup_location_id'];
            $targetDir = "./carImages/"; 
             $uploadedFiles = array();
             $numFiles = count($_FILES['car_photos']['name']);
            if($numFiles == 3){
              $car = new Car($car_make,$car_model, $car_type,$color, $reg_year, $description, $price_per_day, $capacity, $fuel_type, $average_consumption, $horse_power, $length, $width, $plate_number, $restrictions, $status,"","","",$pickup_date,$return_date,$pickup_location_id);
              $crud->createCar($car);
              $car->setCarId($pdo->lastInsertId());
   
    for ($i = 0; $i < $numFiles; $i++) {
        $fileName = basename($_FILES['car_photos']['name'][$i]);
        $targetFilePath = $targetDir . "car" . $car->getCarId() . "img" . ($i + 1) . ".png" ; 
            if (move_uploaded_file($_FILES['car_photos']['tmp_name'][$i], $targetFilePath)) {
                $uploadedFiles[] = $targetFilePath;
            }
        }
        
    

    $photo1 = $uploadedFiles[0];
    $photo2 = $uploadedFiles[1];
    $photo3 = $uploadedFiles[2];
    $car->setPhoto1( $photo1);
    $car->setPhoto2( $photo2);
    $car->setPhoto3( $photo3);
    $crud->updateCar($car);
    echo "<h2 class='success_h2'>Car has been Inserted Successfully! Car ID: {$car->getCarId()}</h2>";
  }else{
    echo '<h2 class="error_h2">3 Car Photos are Required</h2>';
  }

}
          

?>
                <form action="addCar.php" method="POST" enctype="multipart/form-data">
                    <fieldset>
                        <label for="car_make">Car Make:</label><br>
                        <select required id="car_make" name="car_make">
                            <option value="">Select Car Make</option>
                            <option value="Audi">Audi</option>
                            <option value="Chevrolet">Chevrolet</option>
                            <option value="Ford">Ford</option>
                            <option value="Honda">Honda</option>
                            <option value="Hyundai">Hyundai</option>
                            <option value="Kia">Kia</option>
                            <option value="Lexus">Lexus</option>
                            <option value="Mazda">Mazda</option>
                            <option value="Mercedes-Benz">Mercedes-Benz</option>
                            <option value="Nissan">Nissan</option>
                            <option value="Porsche">Porsche</option>
                            <option value="Subaru">Subaru</option>
                            <option value="Tesla">Tesla</option>
                            <option value="Toyota">Toyota</option>
                            <option value="Volkswagen">Volkswagen</option>
                            <option value="Volvo">Volvo</option>

                        </select><br><br>

                        <label for="car_model">Car Model:</label><br>
                        <input required type="text" id="car_model" name="car_model"><br><br>

                        <label for="car_type">Car Type:</label><br>
                        <select required id="car_type" name="car_type">
                            <option value="">Select Car Type</option>
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

                        <label for="reg_year">Registration Year:</label><br>
                        <input required type="text" id="reg_year" name="reg_year"><br><br>

                        <label for="description">Description:</label><br>
                        <textarea required id="description" name="description"></textarea><br><br>

                        <label for="price_per_day">Price Per Day:</label><br>
                        <input required type="text" id="price_per_day" name="price_per_day"><br><br>

                        <label for="capacity">Capacity:</label><br>
                        <input required type="text" id="capacity" name="capacity"><br><br>

                        <label for="colors">Color:</label><br>
                        <input required type="text" id="color" name="color"><br><br>

                        <label for="fuel_type">Fuel Type:</label><br>
                        <select required id="fuel_type" name="fuel_type">
                            <option value="Petrol">Petrol</option>
                            <option value="Diesel">Diesel</option>
                            <option value="Electric">Electric</option>
                            <option value="Hybrid">Hybrid</option>

                        </select><br><br>

                        <label for="average_consumption">Average Consumption per 100 kilometers:</label><br>
                        <input required required type="text" id="average_consumption"
                            name="average_consumption"><br><br>

                        <label for="horse_power">Horse Power:</label><br>
                        <input required type="text" id="horse_power" name="horse_power"><br><br>

                        <label for="length">Length (m):</label><br>
                        <input required type="text" id="length" name="length"><br><br>

                        <label for="width">Width (m):</label><br>
                        <input required type="text" id="width" name="width"><br><br>

                        <label for="plate_number">Plate Number:</label><br>
                        <input required type="text" id="plate_number" name="plate_number"><br><br>

                        <label for="restrictions">Conditions or Restrictions:</label><br>
                        <textarea required id="restrictions" name="restrictions"></textarea><br><br>

                        <label for="status">Status:</label><br>
                        <select required id="status" name="status">
                            <option value="available" selected>Available</option>
                            <option value="rented">Rented</option>
                            <option value="returning">Returning</option>
                        </select><br><br>

                        <label for="pickup_date">Renting Period:</label>
                        <input type="date" id="pickup_date" name="pickup_date" value="<?php echo date('Y-m-d'); ?>"
                            required>
                        <p>To</p>
                        <input type="date" id="return_date" name="return_date"
                            value="<?php echo date('Y-m-d', strtotime('+3 days')); ?>" required><br>

                        <label for="pickup_location_id">Pickup Location:</label><br>
                        <select required id="pickup_location_id" name="pickup_location_id">
                            <?php

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

                        <label for="car_photos">Upload Car Photos (3 photos are required):</label><br>
                        <input required type="file" id="car_photos" name="car_photos[]" accept="image/jpeg, image/png"
                            multiple><br><br>

                        <input type="submit" value="Submit">
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