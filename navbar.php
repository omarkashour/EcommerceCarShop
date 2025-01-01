<?php
require_once("./entities/Account.php");

function isActive($page) {
    return basename($_SERVER['PHP_SELF']) == $page ? 'class="clicked"' : '';
}

?>

<nav class="navbar_container">
  <h2>Navigation Panel</h2>
  <ul>
    <li><a <?php echo isActive('search.php'); ?> href="./search.php">Search Cars</a></li>

    <?php
        if(!isset($_SESSION)) 
        { 
            session_start(); 
        } 
        if(isset($_SESSION['account'])){
            $account = $_SESSION['account'];
            if($account->getAccountType() == "Customer"){
              echo '<li><a ' . isActive('returnCar.php') . ' href="./returnCar.php">Return Car</a></li>';
              echo '<li><a ' . isActive('viewrented.php') . ' href="./viewrented.php">View Rented Cars</a></li>';
              echo '</ul>';
            }
            else if($account->getAccountType() == "Manager"){
              echo '</ul>';
              echo '<h2>Manager Section</h2>';
              echo '<ul>';
              echo '<li><a ' . isActive('addCar.php') . ' href="./addCar.php">Add Car</a></li>';
              echo '<li><a ' . isActive('returnCarManager.php') . ' href="./returnCarManager.php">Return Car</a></li>';
              echo '<li><a ' . isActive('carInquire.php') . ' href="./carInquire.php">Car Inquire</a></li>';
              echo '<li><a ' . isActive('addLocation.php') . ' href="./addLocation.php">Add Location</a></li>';
              echo '</ul>';
            }
        }
        ?>
</nav>