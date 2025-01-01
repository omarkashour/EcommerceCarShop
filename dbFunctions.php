<?php
require_once('entities/Account.php');
require_once("./entities/Car.php");
require_once("./entities/Invoice.php");
require_once("./entities/Location.php");
require_once("./entities/Rented_car.php");
?>

<?php

class dbFunctions
{

  private $pdo;

  public function __construct(PDO $pdo)
  {
    $this->pdo = $pdo;
  }
  public function createAccount(Account $account)
  {
    $stmt = $this->pdo->prepare("INSERT INTO account (account_type, id_number, name, address, dob, email_address, phone_number, username, password, cc_number, cc_expiry_date, cvv, cc_holder_name, cc_bank, cc_type) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([
      $account->getAccountType(),
      $account->getIdNumber(),
      $account->getName(),
      $account->getAddress(),
      $account->getDob(),
      $account->getEmailAddress(),
      $account->getPhoneNumber(),
      $account->getUsername(),
      $account->getPassword(),
      $account->getCcNumber(),
      $account->getCcExpiryDate(),
      $account->getCvv(),
      $account->getCcHolderName(),
      $account->getCcBank(),
      $account->getCcType()
    ]);
    $account->setAccountId($this->pdo->lastInsertId());
  }

  public function getAccount($account_id)
  {
    $stmt = $this->pdo->prepare("SELECT * FROM account WHERE account_id = ?");
    $stmt->execute([$account_id]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($row) {
      return new Account($row['account_type'], $row['id_number'], $row['name'], $row['address'], $row['dob'], $row['email_address'], $row['phone_number'], $row['username'], $row['password'], $row['cc_number'], $row['cc_expiry_date'], $row['ccv'], $row['cc_holder_name'], $row['cc_bank'], $row['cc_type'], $row['account_id']);
    }
    return null;
  }

  public function updateAccount(Account $account)
  {
    $stmt = $this->pdo->prepare("UPDATE account SET account_type = ?, id_number = ?, name = ?, address = ?, dob = ?, email_address = ?, phone_number = ?, username = ?, password = ?, cc_number = ?, cc_expiry_date = ?, cvv = ?, cc_holder_name = ?, cc_bank = ?, cc_type = ? WHERE account_id = ?");
    $stmt->execute([
      $account->getAccountType(),
      $account->getIdNumber(),
      $account->getName(),
      $account->getAddress(),
      $account->getDob(),
      $account->getEmailAddress(),
      $account->getPhoneNumber(),
      $account->getUsername(),
      $account->getPassword(),
      $account->getCcNumber(),
      $account->getCcExpiryDate(),
      $account->getCvv(),
      $account->getCcHolderName(),
      $account->getCcBank(),
      $account->getCcType(),
      $account->getAccountId()
    ]);
  }

  public function deleteAccount($account_id)
  {
    $stmt = $this->pdo->prepare("DELETE FROM account WHERE account_id = ?");
    $stmt->execute([$account_id]);
  }



  // Car CRUD methods
  public function createCar(Car $car)
  {
    $stmt = $this->pdo->prepare("INSERT INTO car (car_make, car_model, car_type, color, reg_year, description, price_per_day, capacity, fuel_type, average_consumption, horse_power, length, width, plate_number, restrictions, status, photo1, photo2, photo3, pickup_date, return_date, pickup_location_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([
      $car->getCarMake(),
      $car->getCarModel(),
      $car->getCarType(),
      $car->getColor(),
      $car->getRegYear(),
      $car->getDescription(),
      $car->getPricePerDay(),
      $car->getCapacity(),
      $car->getFuelType(),
      $car->getAverageConsumption(),
      $car->getHorsePower(),
      $car->getLength(),
      $car->getWidth(),
      $car->getPlateNumber(),
      $car->getRestrictions(),
      $car->getStatus(),
      $car->getPhoto1(),
      $car->getPhoto2(),
      $car->getPhoto3(),
      $car->getPickupDate(),
      $car->getReturnDate(),
      $car->getPickupLocationId()
    ]);
    $car->setCarId($this->pdo->lastInsertId());
  }

  public function getCar($car_id)
  {
    $stmt = $this->pdo->prepare("SELECT * FROM car WHERE car_id = ?");
    $stmt->execute([$car_id]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($row) {
      $car = new Car(
        $row['car_make'],
        $row['car_model'],
        $row['car_type'],
        $row['color'],
        $row['reg_year'],
        $row['description'],
        $row['price_per_day'],
        $row['capacity'],
        $row['fuel_type'],
        $row['average_consumption'],
        $row['horse_power'],
        $row['length'],
        $row['width'],
        $row['plate_number'],
        $row['restrictions'],
        $row['status'],
        $row['photo1'],
        $row['photo2'],
        $row['photo3'],
        $row['pickup_date'],
        $row['return_date'],
        $row['pickup_location_id']
      );
      $car->setCarId($row['car_id']);
      return $car;
    }
    return null;
  }
  public function updateCar(Car $car)
  {
    $stmt = $this->pdo->prepare("UPDATE car SET car_make = ?, car_model = ?, car_type = ?, color = ?, reg_year = ?, description = ?, price_per_day = ?, capacity = ?, fuel_type = ?, average_consumption = ?, horse_power = ?, length = ?, width = ?, plate_number = ?, restrictions = ?, status = ?, photo1 = ?, photo2 = ?, photo3 = ?, pickup_date = ?, return_date = ?, pickup_location_id = ? WHERE car_id = ?");
    $stmt->execute([
      $car->getCarMake(),
      $car->getCarModel(),
      $car->getCarType(),
      $car->getColor(),
      $car->getRegYear(),
      $car->getDescription(),
      $car->getPricePerDay(),
      $car->getCapacity(),
      $car->getFuelType(),
      $car->getAverageConsumption(),
      $car->getHorsePower(),
      $car->getLength(),
      $car->getWidth(),
      $car->getPlateNumber(),
      $car->getRestrictions(),
      $car->getStatus(),
      $car->getPhoto1(),
      $car->getPhoto2(),
      $car->getPhoto3(),
      $car->getPickupDate(),
      $car->getReturnDate(),
      $car->getPickupLocationId(),
      $car->getCarId()
    ]);
  }


  public function deleteCar($car_id)
  {
    $stmt = $this->pdo->prepare("DELETE FROM car WHERE car_id = ?");
    $stmt->execute([$car_id]);
  }




  // Invoice CRUD methods
  public function createInvoice(Invoice $invoice)
  {
    $stmt = $this->pdo->prepare("INSERT INTO invoice (customer_id, car_id, cc_number, cc_holder_name, cc_expiry, cvv, cc_bank, cc_type, total_amount, invoice_date, return_location, pickup_location) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?,?)");
    $stmt->execute([
      $invoice->getCustomerId(),
      $invoice->getCarId(),
      $invoice->getCcNumber(),
      $invoice->getCcHolderName(),
      $invoice->getCcExpiry(),
      $invoice->getCvv(),
      $invoice->getCcBank(),
      $invoice->getCcType(),
      $invoice->getTotalAmount(),
      $invoice->getInvoiceDate(),
      $invoice->getReturnLocation(),
      $invoice->getPickupLocation()
    ]);
    $invoice->setInvoiceId($this->pdo->lastInsertId());
  }

  public function getInvoice($invoice_id)
  {
    $stmt = $this->pdo->prepare("SELECT * FROM invoice WHERE invoice_id = ?");
    $stmt->execute([$invoice_id]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($row) {
      $invoice = new Invoice(
        $row['customer_id'],
        $row['car_id'],
        $row['cc_number'],
        $row['cc_holder_name'],
        $row['cc_expiry'],
        $row['cvv'],
        $row['cc_bank'],
        $row['cc_type'],
        $row['total_amount'],
        $row['invoice_date'],
        $row['return_location'],
        $row['pickup_location']
      );
      $invoice->setInvoiceId($row['invoice_id']);
      return $invoice;
    }
    return null;
  }

  public function updateInvoice(Invoice $invoice)
  {
    $stmt = $this->pdo->prepare("UPDATE invoice SET customer_id = ?, car_id = ?, cc_number = ?, cc_holder_name = ?, cc_expiry = ?, cvv = ?, cc_bank = ?, cc_type = ?, total_amount = ?, invoice_date = ?, return_location = ?, pickup_location = ? WHERE invoice_id = ?");
    $stmt->execute([
      $invoice->getCustomerId(),
      $invoice->getCarId(),
      $invoice->getCcNumber(),
      $invoice->getCcHolderName(),
      $invoice->getCcExpiry(),
      $invoice->getCvv(),
      $invoice->getCcBank(),
      $invoice->getCcType(),
      $invoice->getTotalAmount(),
      $invoice->getInvoiceDate(),
      $invoice->getReturnLocation(),
      $invoice->getPickupLocation(),
      $invoice->getInvoiceId()
    ]);
  }

  public function deleteInvoice($invoice_id)
  {
    $stmt = $this->pdo->prepare("DELETE FROM invoice WHERE invoice_id = ?");
    $stmt->execute([$invoice_id]);
  }
  public function createLocation(Location $location)
  {
    $stmt = $this->pdo->prepare("INSERT INTO location (name, address, phone) VALUES (?, ?, ?)");
    $stmt->execute([
      $location->getName(),
      $location->getAddress(),
      $location->getPhone()
    ]);
    $location->setLocationId($this->pdo->lastInsertId());
  }

  public function getLocation($location_id)
  {
    $stmt = $this->pdo->prepare("SELECT * FROM location WHERE location_id = ?");
    $stmt->execute([$location_id]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($row) {
      return new Location($row['name'], $row['address'], $row['phone'], $row['location_id']);
    }
    return null;
  }

  public function updateLocation(Location $location)
  {
    $stmt = $this->pdo->prepare("UPDATE location SET name = ?, address = ?, phone = ? WHERE location_id = ?");
    $stmt->execute([
      $location->getName(),
      $location->getAddress(),
      $location->getPhone(),
      $location->getLocationId()
    ]);
  }

  public function deleteLocation($location_id)
  {
    $stmt = $this->pdo->prepare("DELETE FROM location WHERE location_id = ?");
    $stmt->execute([$location_id]);
  }

  // RentedCar CRUD methods

  public function createRentedCar(Rented_car $rentedCar)
  {
    $stmt = $this->pdo->prepare("INSERT INTO rented_car (account_id, invoice_id, car_id, pick_up_date, return_date, rent_status, pickup_location_id, return_location_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([
      $rentedCar->getAccountId(),
      $rentedCar->getInvoiceId(),
      $rentedCar->getCarId(),
      $rentedCar->getPickUpDate(),
      $rentedCar->getReturnDate(),
      $rentedCar->getRentStatus(),
      $rentedCar->getPickupLocationId(),
      $rentedCar->getReturnLocationId()
    ]);
  }

  public function getRentedCar($account_id, $invoice_id)
  {
    $stmt = $this->pdo->prepare("SELECT * FROM rented_car WHERE account_id = ? AND invoice_id = ?");
    $stmt->execute([$account_id, $invoice_id]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($row) {
      return new Rented_car($row['account_id'], $row['invoice_id'], $row['car_id'], $row['pick_up_date'], $row['return_date'], $row['rent_status'], $row['pickup_location_id'], $row['return_location_id']);
    }
    return null;
  }

  public function updateRentedCar(Rented_car $rentedCar)
  {
    $stmt = $this->pdo->prepare("UPDATE rented_car SET car_id = ?, pick_up_date = ?, return_date = ?, rent_status = ?, pickup_location_id = ?, return_location_id = ? WHERE account_id = ? AND invoice_id = ?");
    $stmt->execute([
      $rentedCar->getCarId(),
      $rentedCar->getPickUpDate(),
      $rentedCar->getReturnDate(),
      $rentedCar->getRentStatus(),
      $rentedCar->getPickupLocationId(),
      $rentedCar->getReturnLocationId(),
      $rentedCar->getAccountId(),
      $rentedCar->getInvoiceId()
    ]);
  }

  public function deleteRentedCar($account_id, $invoice_id)
  {
    $stmt = $this->pdo->prepare("DELETE FROM rented_car WHERE account_id = ? AND invoice_id = ?");
    $stmt->execute([$account_id, $invoice_id]);
  }
}

?>