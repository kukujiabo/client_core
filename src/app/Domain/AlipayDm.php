<?php
namespace App\Domain;

use App\Service\Components\Alipay\AlipayAppSv;

class AlipayDm {

  protected $_aapSv;

  public function __construct() {
  
    $this->_aapSv = new AlipayAppSv(); 
  
  }

  public function paymentNotify($data) {
  
    return $this->_aapSv->paymentNotify($data);
  
  }

  public function payOff($data) {
  
    return $this->_aapSv->payOff($data);
  
  }

}
