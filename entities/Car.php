<?php

class Car
{
    private $car_id;

    private $car_make;
    private $car_model;
    private $car_type;
    private $reg_year;
    private $description;
    private $price_per_day;
    private $capacity;
    private $fuel_type;
    private $average_consumption;
    private $horse_power;
    private $length;
    private $width;
    private $plate_number;
    private $restrictions;
    private $status;

    private $color;

    private $photo1;
    private $photo2;
    private $photo3;

    private $pickup_date;
    private $return_date;
    private $pickup_location_id;



    public function __construct($car_make, $car_model, $car_type, $color, $reg_year, $description, $price_per_day, $capacity, $fuel_type, $average_consumption, $horse_power, $length, $width, $plate_number, $restrictions, $status, $photo1, $photo2, $photo3, $pickup_date, $return_date, $pickup_location_id)
    {
        $this->color = $color;
        $this->car_make = $car_make;
        $this->car_model = $car_model;
        $this->car_type = $car_type;
        $this->reg_year = $reg_year;
        $this->description = $description;
        $this->price_per_day = $price_per_day;
        $this->capacity = $capacity;
        $this->fuel_type = $fuel_type;
        $this->average_consumption = $average_consumption;
        $this->horse_power = $horse_power;
        $this->length = $length;
        $this->width = $width;
        $this->plate_number = $plate_number;
        $this->restrictions = $restrictions;
        $this->status = $status;
        $this->photo1 = $photo1;
        $this->photo2 = $photo2;
        $this->photo3 = $photo3;
        $this->pickup_date = $pickup_date;
        $this->return_date = $return_date;
        $this->pickup_location_id = $pickup_location_id;
    }

    // Getters
    public function getCarId()
    {
        return $this->car_id;
    }

    public function getCarMake()
    {
        return $this->car_make;
    }

    public function getCarModel()
    {
        return $this->car_model;
    }

    public function getCarType()
    {
        return $this->car_type;
    }

    public function getRegYear()
    {
        return $this->reg_year;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getPricePerDay()
    {
        return $this->price_per_day;
    }

    public function getColor()
    {
        return $this->color;
    }


    public function setColor($color)
    {
        $this->color = $color;
    }


    public function getPhoto1()
    {
        return $this->photo1;
    }


    public function setPhoto1($photo1)
    {
        $this->photo1 = $photo1;
    }


    public function getPhoto2()
    {
        return $this->photo2;
    }

    public function setPhoto2($photo2)
    {
        $this->photo2 = $photo2;
    }

    public function getPhoto3()
    {
        return $this->photo3;
    }


    public function setPhoto3($photo3)
    {
        $this->photo3 = $photo3;
    }
    public function getCapacity()
    {
        return $this->capacity;
    }

    public function getFuelType()
    {
        return $this->fuel_type;
    }

    public function getAverageConsumption()
    {
        return $this->average_consumption;
    }

    public function getHorsePower()
    {
        return $this->horse_power;
    }

    public function getLength()
    {
        return $this->length;
    }

    public function getWidth()
    {
        return $this->width;
    }

    public function getPlateNumber()
    {
        return $this->plate_number;
    }

    public function getRestrictions()
    {
        return $this->restrictions;
    }

    public function getStatus()
    {
        return $this->status;
    }

    // Setters
    public function setCarId($car_id)
    {
        $this->car_id = $car_id;
    }

    public function setCarMake($car_make)
    {
        $this->car_make = $car_make;
    }

    public function setCarModel($car_model)
    {
        $this->car_model = $car_model;
    }

    public function setCarType($car_type)
    {
        $this->car_type = $car_type;
    }

    public function setRegYear($reg_year)
    {
        $this->reg_year = $reg_year;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function setPricePerDay($price_per_day)
    {
        $this->price_per_day = $price_per_day;
    }

    public function setCapacity($capacity)
    {
        $this->capacity = $capacity;
    }

    public function setFuelType($fuel_type)
    {
        $this->fuel_type = $fuel_type;
    }

    public function setAverageConsumption($average_consumption)
    {
        $this->average_consumption = $average_consumption;
    }

    public function setHorsePower($horse_power)
    {
        $this->horse_power = $horse_power;
    }

    public function setLength($length)
    {
        $this->length = $length;
    }

    public function setWidth($width)
    {
        $this->width = $width;
    }

    public function setPlateNumber($plate_number)
    {
        $this->plate_number = $plate_number;
    }

    public function setRestrictions($restrictions)
    {
        $this->restrictions = $restrictions;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }


    // Setter for pickup_date
    public function setPickupDate($pickup_date)
    {
        $this->pickup_date = $pickup_date;
    }

    public function getPickupDate()
    {
        return $this->pickup_date;
    }

    public function setReturnDate($return_date)
    {
        $this->return_date = $return_date;
    }

    public function getReturnDate()
    {
        return $this->return_date;
    }


    public function setPickupLocationId($pickup_location_id)
    {
        $this->pickup_location_id = $pickup_location_id;
    }


    public function getPickupLocationId()
    {
        return $this->pickup_location_id;
    }


    public function generateCarRow()
    {
        $fuelClass = 'fuel-' . strtolower($this->getFuelType());
        echo "
        <tr class='{$fuelClass}'>
            <td><input type='checkbox' name='car_id[]' value='{$this->getCarId()}' class='shortlist'></td>
            <td>\${$this->getPricePerDay()}</td>
            <td>{$this->getCarType()}</td>
            <td>{$this->getFuelType()}</td>
            <td><img src='{$this->getPhoto1()}' alt='Car Photo''></td>
            <td><a href='./rentCar.php?id={$this->getCarId()}'><button type='button'>Rent</button></a></td>
        </tr>
        ";
    }

    public function generateCarBasketRow()
    {
        $fuelClass = 'fuel-' . strtolower($this->getFuelType());
        echo "
        <tr class='{$fuelClass}'>
            <td>\${$this->getPricePerDay()}</td>
            <td>{$this->getCarMake()}</td>
            <td>{$this->getCarModel()}</td>
            <td>{$this->getCarType()}</td>
            <td>{$this->getFuelType()}</td>
            <td><img src='{$this->getPhoto1()}' alt='Car Photo''></td>
            <td><a href='./rentCar.php?id={$this->getCarId()}'><button>Rent</button></a></td>
        </tr>
        ";
    }

    public function generateManagerCarRow()
    {
        $fuelClass = 'fuel-' . strtolower($this->getFuelType());
        echo "
        <tr class='{$fuelClass}'>
            <td>{$this->getCarId()}</td>
            <td>{$this->getCarType()}</td>
            <td>{$this->getCarModel()}</td>
            <td>{$this->getDescription()}</td>
            <td><img src='{$this->getPhoto1()}' alt='Car Photo''></td>
            <td>{$this->getFuelType()}</td>
            <td>{$this->getStatus()}</td>
        </tr>
        ";
    }
    public function displayCarDetails()
    {
        echo "<div class='car-details-container'>";

        echo "<div class='car-photos'>";
        echo "<img src='{$this->getPhoto1()}' alt='Car Photo'>";
        echo "<img src='{$this->getPhoto2()}' alt='Car Photo'>";
        echo "<img src='{$this->getPhoto3()}' alt='Car Photo'>";
        echo "</div>";

        echo "<div class='car-info'>";
        echo "<ul>";
        echo "<li><strong>Car Reference Number:</strong> {$this->getCarId()}</li>";
        echo "<li><strong>Car Model:</strong> {$this->getCarModel()}</li>";
        echo "<li><strong>Car Type:</strong> {$this->getCarType()}</li>";
        echo "<li><strong>Car Make:</strong> {$this->getCarMake()}</li>";
        echo "<li><strong>Registration Year:</strong> {$this->getRegYear()}</li>";
        echo "<li><strong>Color:</strong> {$this->getColor()}</li>";
        echo "<li><strong>Description:</strong> {$this->getDescription()}</li>";
        echo "<li><strong>Price Per Day:</strong> \${$this->getPricePerDay()}</li>";
        echo "<li><strong>Capacity of People:</strong> {$this->getCapacity()}</li>";
        echo "<li><strong>Fuel Type:</strong> {$this->getFuelType()}</li>";
        echo "<li><strong>Average Consumption:</strong> {$this->getAverageConsumption()} L/100km</li>";
        echo "<li><strong>Horsepower:</strong> {$this->getHorsePower()} hp</li>";
        echo "<li><strong>Length:</strong> {$this->getLength()}m</li>";
        echo "<li><strong>Width:</strong> {$this->getWidth()}m</li>";
        echo "<li><strong>Restrictions:</strong> {$this->getRestrictions()}</li>";

        echo "</ul>";
        echo "<a href='./rentStep1.php?id={$this->getCarId()}'><button>Rent Car</button></a>";
        echo "</div>";

        include('sale.php');

        echo "</div>";
    }



    public function generateReturnCarRow($return_location)
    {
        $pickupDateObj = new DateTime($this->getPickupDate());
        $returnDateObj = new DateTime($this->getReturnDate());

        echo "
        <tr>
            <td>{$this->getCarId()}</td>
            <td>{$this->getCarMake()}</td>
            <td>{$this->getCarType()}</td>
            <td>{$this->getCarModel()}</td>
            <td>{$pickupDateObj->format('Y-m-d')}</td>
            <td>{$returnDateObj->format('Y-m-d')}</td>
            <td>{$return_location}</td>
            <td><a href='./returnCar.php?id={$this->getCarId()}'><button>Return</button></a></td>
        </tr>";
    }
    public function generateReturnCarManagerRow($customer_name, $return_location)
    {
        $pickupDateObj = new DateTime($this->getPickupDate());
        $returnDateObj = new DateTime($this->getReturnDate());

        echo "
        <tr>
            <td>{$customer_name}</td>
            <td>{$this->getCarId()}</td>
            <td>{$this->getCarMake()}</td>
            <td>{$this->getCarType()}</td>
            <td>{$this->getCarModel()}</td>
            <td>{$pickupDateObj->format('Y-m-d')}</td>
            <td>{$returnDateObj->format('Y-m-d')}</td>
            <td>{$return_location}</td>
            <td><a href='./returnCarManager.php?id={$this->getCarId()}'><button>Return</button></a></td>
        </tr>";
    }
}
