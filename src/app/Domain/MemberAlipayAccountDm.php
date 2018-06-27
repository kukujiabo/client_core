<?php
namespace App\Domain;

use App\Service\Account\MemberAlipayAccountSv;

class MemberAlipayAccountDm {

  protected $_mapsv;

  public function __construct() {
  
    $this->_mapsv = new MemberAlipayAccountSv();
  
  }

  public function create($data) {
  
    return $this->_mapsv->create($data); 
  
  }

  public function getDetail($data) {
  
    return $this->_mapsv->getDetail($data);
  
  }

}
