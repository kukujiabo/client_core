<?php
namespace App\Domain;

use App\Service\Crm\LoanRewardRuleSv;

class LoanRewardRuleDm {

  protected $_lrrSv;

  public function __construct() {
  
    $this->_lrrSv = new LoanRewardRuleSv();
  
  }

  public function create($data) {
  
    return $this->_lrrSv->create($data);
  
  }

  public function getList($data) {
  
    return $this->_lrrSv->getList($data);
  
  }


}
