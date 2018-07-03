<?php
namespace App\Domain;

use App\Service\Account\CashApplySv;

class CashApplyDm {

  protected $_casv;

  public function __construct() {
  
    $this->_casv = new CashApplySv();
  
  }

  public function create($data) {
  
    return $this->_casv->create($data);
  
  }

  public function getList() {
  
    return $this->_casv->getList($data);
  
  }


}
