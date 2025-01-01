<?php

class Location {
    private $location_id;
    private $name;
    private $address;
    private $phone;

    public function __construct($name, $address, $phone, $location_id = null) {
        $this->location_id = $location_id;
        $this->name = $name;
        $this->address = $address;
        $this->phone = $phone;
    }

    // Getters
    public function getLocationId() {
        return $this->location_id;
    }

    public function getName() {
        return $this->name;
    }

    public function getAddress() {
        return $this->address;
    }

    public function getPhone() {
        return $this->phone;
    }

    // Setters
    public function setLocationId($location_id) {
        $this->location_id = $location_id;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setAddress($address) {
        $this->address = $address;
    }

    public function setPhone($phone) {
        $this->phone = $phone;
    }

  
}

?>