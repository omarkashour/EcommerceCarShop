<?php
include "db.inc.php"; 

include("./entities/Account.php");
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
  <link rel="stylesheet" href="style.css" />
  <title>Sticky Rentals</title>
</head>

<body>



  <div class="vertical_container">
    <?php include "header.php"; ?>

    <div class="horizontal_container">

      <?php include "navbar.php"; ?>

      <main class="login_main_container">

        <h1>Login</h1>
        <?php

          if($_SERVER['REQUEST_METHOD'] == "POST"){
            $username = $_POST["username"];
            $password = $_POST["password"];
            
            $sql = "Select * from account a where a.username = ? and a.password = ?";
           $statement =  $pdo->prepare($sql);
            $statement->bindValue(1,$username);
            $statement->bindValue(2,$password);
            $statement->execute();
            $result = $statement->rowCount();
            if($result == 0){
              echo'<p>Invalid Username or Password</p>';
            }
            else{
              echo 'account found';
              $result= $statement->fetchAll();
              foreach($result as $row){
                $account_type = $row["account_type"];
                $id_number = $row['id_number'];
                $name = $row['name'];
                $address = $row['address'];
                $dob = $row['dob'];
                $email_address = $row['email_address'];
                $phone_number = $row['phone_number'];
                $username = $row['username'];
                $password = $row['password'];
                $cc_number = $row['cc_number'];
                $cvv = $row['cvv'];
                $cc_expiry_date = $row['cc_expiry_date'];
                $cc_holder_name = $row['cc_holder_name'];
                $cc_bank = $row['cc_bank'];
                $account = new Account($account_type,$id_number,$name,$address,$dob,$email_address,$phone_number,$username,$password,$cc_number,$cc_expiry_date,$cvv,$cc_holder_name,$cc_bank,"Visa");
                $account->setAccountId($row['account_id']);
                if(!isset($_SESSION)) 
                { 
                    session_start(); 
                } 
                $_SESSION['account'] = $account;
              }

              if($_SESSION['redirect'] == true){
                header("Location: " . "{$_SESSION['redirect_original_url']}");
              }
              else
              header("Location: ./index.php");
            }
            
          }

        ?>

        <form action="login.php" method="POST">
          <fieldset>
            <h2>User Details:</h2>


            <br>
            <label for="username">Username:</label> <br>
            <input type="text" id="username" name="username" required> <br>

            <label for="password">Password:</label><br>
            <input type="password" id="password" name="password" required> <br><br>

            <input type="submit" name="submit" value="Login">
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