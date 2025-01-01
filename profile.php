<?php
include "db.inc.php"; 
include("dbFunctions.php");
require_once ('entities/Account.php');

$crud = new dbFunctions($pdo);

?>

<?php

if(!isset($_SESSION)) 
{ 
    session_start(); 
} 

if(!isset($_SESSION['account'])){
  
header("Location: registerStep1.php");
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

            <main class="profile_main_container">
                <h1>Your Profile</h1>

                <?php

                if($_SERVER['REQUEST_METHOD'] == "POST"){
                  $customer_id = $_POST['customer_id'];
                  $name = $_POST['name'];
                  $address = $_POST['address'];
                  $dob = $_POST['dob'];
                  $id_number = $_POST['id_number'];
                  $email = $_POST['email'];
                  $phone_number = $_POST['phone_number'];
                  $cc_number = $_POST['cc_number'];
                  $cvv = $_POST['cvv'];
                  $cc_expiry_date = $_POST['cc_expiry_date'];
                  $cc_holder_name = $_POST['holder_name'];
                  $cc_bank = $_POST['cc_bank'];
                  $username = $_POST['username'];
                  $password = $_POST['password'];
                  $confirm_password = $_POST['confirm_password'];
                  if ($password!= $confirm_password) {
                    echo'<h2 class="error_h2">Passwords do not match!</h2>';         
                   }
                   else{
                  $account = new Account("Customer",$id_number,$name,$address,$dob,$email,$phone_number,$username,$password,$cc_number,$cc_expiry_date,$cvv,$cc_holder_name,$cc_bank,"Visa");
                  $account->setAccountId($customer_id);
                  $crud->updateAccount($account);
                  echo'<h2 class="success_h2">Your Profile has been Updated Successfully!</h2>';
                  $_SESSION['account']=$account;
                   }
                }

                  if(!isset($_SESSION)) 
                  { 
                      session_start(); 
                  } 

                  $account = $_SESSION['account'];
   

                echo "
                <form action='profile.php' method='POST'>
                <fieldset>
                    <h2>Customer Details:</h2>
                    <br>
                    <label for='customer_id'>Customer ID:</label> <br>
                    <input type='text' id='customer_id' name='customer_id' readonly value='{$account->getAccountId()}'> <br>
            
                    <label for='name'>Customer Name:</label> <br>
                    <input type='text' id='name' name='name' required value='{$account->getName()}'> <br>
            
                    <label for='address'>Address:</label><br>
                    <input type='text' id='address' name='address' required value='{$account->getAddress()}'> <br>
            
                    <label for='dob'>Date of Birth:</label><br>
                    <input type='date' id='dob' name='dob' required value='{$account->getDob()}'> <br><br>
            
                    <label for='id_number'>ID Number:</label><br>
                    <input type='text' id='id_number' name='id_number' required value='{$account->getIdNumber()}'> <br>
            
                    <label for='email'>Email Address:</label><br>
                    <input type='text' id='email' name='email' required value='{$account->getEmailAddress()}'> <br> <br>
            
                    <label for='phone_number'>Phone Number:</label><br>
                    <input type='text' id='phone_number' name='phone_number' required value='{$account->getPhoneNumber()}'> <br> <br>
                    <h2>Credit Card Details:</h2>
                    <br>
                    <label for='cc_number'>CC Number:</label><br>
                    <input type='text' id='cc_number' name='cc_number' required value='{$account->getCcNumber()}'>  <br>
            
                    <label for='cvv'>CVV:</label><br>
                    <input type='text' id='cvv' name='cvv' required  value='{$account->getCvv()}'> <br>
            
                    <label for='cc_expiry_date'>Expiry Date:</label><br>
                    <input type='date' id='cc_expiry_date' name='cc_expiry_date' required value='{$account->getCcExpiryDate()}'> <br><br>
            
                    <label for='holder_name'>Holder Name:</label><br>
                    <input type='text' id='holder_name' name='holder_name' required value='{$account->getCcHolderName()}'> <br>
            
                    <label for='cc_bank'>Bank:</label><br>
                    <input type='text' id='cc_bank' name='cc_bank' required value='{$account-> getCcBank()}'> <br>
                    <h2>E-Account Details:</h2>
            
                    <br>
                    <label for='username'>Username:</label> <br>
                    <input type='text' id='username' name='username' required value='{$account->getUsername()}'> <br>
            
                    <label for='password'>Password:</label><br>
                    <input type='password' id='password' name='password' required value='{$account->getPassword()}'> <br><br>
            
                    <label for='confirm_password'>Confirm Password:</label><br>
                    <input type='password' id='confirm_password' name='confirm_password' required value='{$account->getPassword()}'> <br><br>
            
                    <input type='submit' name='submit' value='Update'>
                </fieldset>
            </form>
            
";
                ?>
            </main>
        </div>

        <div class="footer_container">
            <?php include "footer.php"; ?>
        </div>
    </div>



</body>

</html>