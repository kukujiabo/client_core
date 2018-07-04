<?php
namespace App\Domain;

use App\Service\Commodity\AuditLoanSv;

class AuditLoanDm {

  protected $_alSv;

  public function __construct() {
  
    $this->_alSv = new AuditLoanSv();
  
  }

  public function getList($data) {
  
    return $this->_alSv->getList($data);
  
  }

}
