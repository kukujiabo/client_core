<?php
namespace App\Domain;

use App\Service\Account\AccountLogSv;

class AccountLogDm {

  protected $_aclsv;

  public function __construct() {
  
    $this->_aclsv = new AccountLogSv();
  
  }

  public function getList($data) {
  
    return $this->_aclsv->getList($data); 
  
  }


}
