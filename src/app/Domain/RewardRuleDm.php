<?php
namespace App\Domain;

use App\Service\Crm\RewardRuleSv;

class RewardRuleDm {

  protected $_rrSv;

  public function __construct() {
  
    $this->_rrSv = new RewardRuleSv();
  
  }

  public function create($data) {
  
    return $this->_rrSv->create($data);
  
  }

  public function getList($data) {
  
    return $this->_rrSv->getList($data);
  
  }

}
