<?php
namespace App\Domain;

use App\Service\Crm\MemberTurnoverSv;

class MemberTurnoverDm {

  protected $_mtsv;

  public function __construct() {
  
    $this->_mtsv = new MemberTurnoverSv();
  
  }

  public function getList($params) {
  
    return $this->_mtsv->getList($params);
  
  }

}
