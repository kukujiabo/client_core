<?php
namespace App\Domain;

use App\Service\Commodity\LoanDataSv;

class LoanDataDm {

  protected $_lnSv;

  public function __construct() {
  
    $this->_lnSv = new LoanDataSv();
  
  }

  public function reconciliation($data) {
   
    return $this->_lnSv->reconciliation($data); 
  
  }

}
