<?php
namespace App\Domain;

use App\Service\Commodity\YPosSv;

class YPosDm {

  public function __construct() {
  
    $this->_ypos = new YPosSv();
  
  }

  public function create($data) {
  
    return $this->_ypos->create($data);
  
  }

  public function getList($data) {
  
    return $this->_ypos->getList($data);
  
  }

}
