<?php
namespace App\Domain;

use App\Service\Merchant\BankDataSv;

class BankDataDm {

  protected $_bdsv;

  public function __construct() {
  
    $this->_bdsv = new BankDataSv();
  
  }

  public function reconciliation($data) {
  
    return $this->_bdsv->reconciliation($data); 
  
  }

  public function getList($data) {
  
    return $this->_bdsv->getList($data);
  
  }

}
