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

  public function listCardQuery($data) {
   
    return $this->_baSv->listCardQuery($data); 
  
  }

  public function getReferenceCards($data) {
  
    return $this->_baSv->getReferenceCards($data);
  
  }

  public function getReferenceLoans($data) {
  
    return $this->_baSv->getReferenceLoans($data);
  
  }

  public function balanceCreditMoney($data) {
  
    return $this->_baSv->balanceCreditMoney($data);
  
  }

  public function listLoanQuery($data) {
  
    return $this->_baSv->listLoanQuery($data);
  
  }

  public function balanceLoanMoney($data) {
  
    return $this->_baSv->balanceLoanMoney($data);
  
  }

  public function auditPass($data) {
  
    return $this->_baSv->auditPass($data); 
  
  }

  public function auditFail($data) {
  
    return $this->_baSv->auditFail($data);
  
  }

}
