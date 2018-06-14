<?php
namespace App\Domain;

use App\Service\Merchant\BusinessApplySv;

class BusinessApplyDm {

  protected $_baSv;

  public function __construct() {
  
    $this->_baSv = new BusinessApplySv();
  
  }

  public function create($data) {
  
    return $this->_baSv->create($data);
  
  }

  public function listQuery($data) {
   
    return $this->_baSv->listQuery($data); 
  
  }

}
