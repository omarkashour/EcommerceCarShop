<?php

class Account {
    private $account_id;
    private $account_type;
    private $id_number;
    private $name;
    private $address;
    private $dob;
    private $email_address;
    private $phone_number;
    private $username;
    private $password;

    
    private $cc_number;
    private $cc_expiry_date;
    private $cvv;
    private $cc_holder_name;
    private $cc_bank;
    private $cc_type;
    
    public function __construct($account_type, $id_number, $name, $address, $dob, $email_address, $phone_number, $username, $password, $cc_number, $cc_expiry_date, $cvv, $cc_holder_name, $cc_bank, $cc_type) {
        $this->account_type = $account_type;
        $this->id_number = $id_number;
        $this->name = $name;
        $this->address = $address;
        $this->dob = $dob;
        $this->email_address = $email_address;
        $this->phone_number = $phone_number;
        $this->username = $username;
        $this->password = $password;
        $this->cc_number = $cc_number;
        $this->cc_expiry_date = $cc_expiry_date;
        $this->cvv = $cvv;
        $this->cc_holder_name = $cc_holder_name;
        $this->cc_bank = $cc_bank;
        $this->cc_type = $cc_type;
    }



    // Getters
    public function getAccountId() {
        return $this->account_id;
    }

    public function getAccountType() {
        return $this->account_type;
    }

    public function getIdNumber() {
        return $this->id_number;
    }

    public function getName() {
        return $this->name;
    }

    public function getAddress() {
        return $this->address;
    }

    public function getDob() {
        return $this->dob;
    }

    public function getEmailAddress() {
        return $this->email_address;
    }

    public function getPhoneNumber() {
        return $this->phone_number;
    }

    // Setters
    public function setAccountId($account_id) {
        $this->account_id = $account_id;
    }

    public function setAccountType($account_type) {
        $this->account_type = $account_type;
    }

    public function setIdNumber($id_number) {
        $this->id_number = $id_number;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setAddress($address) {
        $this->address = $address;
    }

    public function setDob($dob) {
        $this->dob = $dob;
    }

    public function setEmailAddress($email_address) {
        $this->email_address = $email_address;
    }

    public function setPhoneNumber($phone_number) {
        $this->phone_number = $phone_number;
    }

    
    public function getUsername() {
      return $this->username;
  }

  public function getPassword() {
      return $this->password;
  }



  public function setUsername($username) {
      $this->username = $username;
  }

  public function setPassword($password) {
      $this->password = $password;
  }

  public function getCcNumber() {
    return $this->cc_number;
}

public function getCcExpiryDate() {
    return $this->cc_expiry_date;
}

public function getCvv() {
    return $this->cvv;
}

public function getCcHolderName() {
    return $this->cc_holder_name;
}

public function getCcBank() {
    return $this->cc_bank;
}

public function getCcType() {
    return $this->cc_type;
}


public function setCcNumber($cc_number) {
    $this->cc_number = $cc_number;
}

public function setCcExpiryDate($cc_expiry_date) {
    $this->cc_expiry_date = $cc_expiry_date;
}

public function setCvv($cvv) {
    $this->cvv = $cvv;
}

public function setCcHolderName($cc_holder_name) {
    $this->cc_holder_name = $cc_holder_name;
}

public function setCcBank($cc_bank) {
    $this->cc_bank = $cc_bank;
}

public function setCcType($cc_type) {
    $this->cc_type = $cc_type;
}

}

?>