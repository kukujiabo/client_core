<?php
namespace App\Domain;

use App\Service\Commodity\PosMechineSv;

class PosMechineDm {

  protected $_pmsv;

  public function __construct() {
  
    $this->_pmsv = new PosMechineSv();
  
  }

  public function create($data) {
  
    return $this->_pmsv->create($data);  
  
  }

  public function getList($data) {
  
    return $this->_pmsv->getList($data);  
  
  }

}
