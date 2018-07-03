<?php
namespace App\Domain;

use App\Service\Commodity\LoanDataSv;
use App\Service\Commodity\AuditLoanSv;
class LoanDataDm {

  protected $_lnSv;

  public function __construct() {
  
    $this->_lnSv = new LoanDataSv();
  
  }

  public function reconciliation($data) {
   
    return $this->_lnSv->reconciliation($data); 
  
  }

  public function getList($data) {
  
    return $this->_lnSv->getList($data); 
  
  }

  public function importData($data) {
  
    return $this->_lnSv->importData($data);
  
  }

  public function balanceOfAccount($data) {

    $alSv = new AuditLoanSv();
  
    return $alSv->balanceOfAccount($alSv);

  }

}
