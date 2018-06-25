<?php
namespace App\Domain;

use App\Service\Account\AccountSv;

class AccountDm {

  protected $_acsv;

  public function __construct() {
  
    $this->_acsv = new AccountSv();
  
  }

  public function create($data) {
  
    return $this->_acsv->create($data); 
  
  }

  public function addMoney($data) {
  
    return $this->_acsv->addMoney($data);
  
  }

  public function minuMoney($data) {
  
    return $this->_acsv->minuMoney($data); 
  
  }

  public function getDetail($data) {
  
    return $this->_acsv->getDetail($data);
  
  }

}
