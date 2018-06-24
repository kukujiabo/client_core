<?php
namespace App\Domain;

use App\Service\Crm\WithdrawSv;

class WithdrawDm {

  protected $_wdsv;

  public function __construct() {
  
    $this->_wdsv = new WithdrawSv();
  
  }

  public function create($data) {
  
    return $this->_wdsv->create($data);
  
  }

}
