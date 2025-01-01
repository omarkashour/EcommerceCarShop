<?php

class Rented_car {
    private $account_id;
    private $invoice_id;
    private $car_id;
    private $pick_up_date;
    private $return_date;
    private $rent_status;
    private $pickup_location_id;
    private $return_location_id;

    public function __construct($account_id, $invoice_id, $car_id, $pick_up_date, $return_date, $rent_status, $pickup_location_id, $return_location_id) {
        $this->account_id = $account_id;
        $this->invoice_id = $invoice_id;
        $this->car_id = $car_id;
        $this->pick_up_date = $pick_up_date;
        $this->return_date = $return_date;
        $this->rent_status = $rent_status;
        $this->pickup_location_id = $pickup_location_id;
        $this->return_location_id = $return_location_id;
    }

    // Getters
    public function getAccountId() {
        return $this->account_id;
    }

    public function getInvoiceId() {
        return $this->invoice_id;
    }

    public function getCarId() {
        return $this->car_id;
    }

    public function getPickUpDate() {
        return $this->pick_up_date;
    }

    public function getReturnDate() {
        return $this->return_date;
    }

    public function getRentStatus() {
        return $this->rent_status;
    }

    public function getPickupLocationId() {
        return $this->pickup_location_id;
    }

    public function getReturnLocationId() {
        return $this->return_location_id;
    }

    // Setters
    public function setAccountId($account_id) {
        $this->account_id = $account_id;
    }

    public function setInvoiceId($invoice_id) {
        $this->invoice_id = $invoice_id;
    }

    public function setCarId($car_id) {
        $this->car_id = $car_id;
    }

    public function setPickUpDate($pick_up_date) {
        $this->pick_up_date = $pick_up_date;
    }

    public function setReturnDate($return_date) {
        $this->return_date = $return_date;
    }

    public function setRentStatus($rent_status) {
        $this->rent_status = $rent_status;
    }

    public function setPickupLocationId($pickup_location_id) {
        $this->pickup_location_id = $pickup_location_id;
    }

    public function setReturnLocationId($return_location_id) {
        $this->return_location_id = $return_location_id;
    }

 
}

?>