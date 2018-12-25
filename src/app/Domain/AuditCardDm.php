<?php
namespace App\Domain;

use App\Service\Merchant\AuditCardSv;

class AuditCardDm {

  protected $_acsv;

  public function __construct() {
  
    $this->_acsv = new AuditCardSv();
  
  }

  public function getList($data) {
  
    return $this->_acsv->getList($data);
  
  }

  public function balanceOfAccount($params) {
  
    return $this->_acsv->balanceOfAccount($params);
  
  }

  public function getAll($params) {

    return $this->_acsv->getAll($params);

  }

}
