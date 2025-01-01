<?php
class Invoice
{
    private $invoice_id;
    private $customer_id;
    private $car_id;
    private $cc_number;
    private $cc_holder_name;
    private $cc_expiry;
    private $cvv;
    private $cc_bank;
    private $cc_type;
    private $total_amount;
    private $invoice_date;

    private $return_location;
    private $pickup_location;

    // Constructor
    public function __construct($customer_id, $car_id, $cc_number, $cc_holder_name, $cc_expiry, $cvv, $cc_bank, $cc_type, $total_amount, $invoice_date, $return_location, $pickup_location)
    {
        $this->customer_id = $customer_id;
        $this->car_id = $car_id;
        $this->cc_number = $cc_number;
        $this->cc_holder_name = $cc_holder_name;
        $this->cc_expiry = $cc_expiry;
        $this->cvv = $cvv;
        $this->cc_bank = $cc_bank;
        $this->cc_type = $cc_type;
        $this->total_amount = $total_amount;
        $this->invoice_date = $invoice_date;
        $this->return_location = $return_location;
        $this->pickup_location = $pickup_location;
    }
    // Getters and Setters
    public function getInvoiceId()
    {
        return $this->invoice_id;
    }

    public function setInvoiceId($invoice_id)
    {
        $this->invoice_id = $invoice_id;
    }

    public function getCustomerId()
    {
        return $this->customer_id;
    }

    public function setCustomerId($customer_id)
    {
        $this->customer_id = $customer_id;
    }

    public function getCarId()
    {
        return $this->car_id;
    }

    public function setCarId($car_id)
    {
        $this->car_id = $car_id;
    }

    public function getCcNumber()
    {
        return $this->cc_number;
    }

    public function setCcNumber($cc_number)
    {
        $this->cc_number = $cc_number;
    }

    public function getCcHolderName()
    {
        return $this->cc_holder_name;
    }

    public function setCcHolderName($cc_holder_name)
    {
        $this->cc_holder_name = $cc_holder_name;
    }

    public function getCcExpiry()
    {
        return $this->cc_expiry;
    }

    public function setCcExpiry($cc_expiry)
    {
        $this->cc_expiry = $cc_expiry;
    }

    public function getCvv()
    {
        return $this->cvv;
    }

    public function setCvv($cvv)
    {
        $this->cvv = $cvv;
    }

    public function getCcBank()
    {
        return $this->cc_bank;
    }

    public function setCcBank($cc_bank)
    {
        $this->cc_bank = $cc_bank;
    }

    public function getCcType()
    {
        return $this->cc_type;
    }

    public function setCcType($cc_type)
    {
        $this->cc_type = $cc_type;
    }

    public function getTotalAmount()
    {
        return $this->total_amount;
    }

    public function setTotalAmount($total_amount)
    {
        $this->total_amount = $total_amount;
    }

    public function getInvoiceDate()
    {
        return $this->invoice_date;
    }

    public function setInvoiceDate($invoice_date)
    {
        $this->invoice_date = $invoice_date;
    }

    public function getReturnLocation()
    {
        return $this->return_location;
    }

    public function setReturnLocation($return_location)
    {
        $this->return_location = $return_location;
    }


    public function getPickupLocation()
    {
        return $this->pickup_location;
    }

    public function setPickupLocation($pickup_location)
    {
        $this->pickup_location = $pickup_location;
    }

    function generateInvoiceTableRow($carType, $carModel, $pickUpDate, $returnDate)
    {
        $currentDate = new DateTime();
        $pickUpDateObj = new DateTime($pickUpDate);
        $returnDateObj = new DateTime($returnDate);
        $invoiceDateObj = new DateTime($this->getInvoiceDate());

        $class = "";
        if ($pickUpDateObj > $currentDate) {
            $status = 'future';
            $class = "future";
        } elseif ($returnDateObj > $currentDate) {
            $status = 'current';
            $class = "current";
        } else {
            $status = 'past';
            $class = "past";
        }

        echo "
        <tr class='{$class}'>
            <td>{$this->getInvoiceId()}</td>
            <td>{$invoiceDateObj->format('Y-m-d')}</td>
            <td>$carType</td>
            <td>$carModel</td>
            <td>{$pickUpDateObj->format('Y-m-d')}</td>
            <td>{$this->getPickupLocation()}</td>
            <td>{$returnDateObj->format('Y-m-d')}</td>
            <td>{$this->getReturnLocation()}</td>
            <td>{$status}</td>
        </tr>";
    }
}
