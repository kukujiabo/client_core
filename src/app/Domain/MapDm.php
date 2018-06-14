<?php
namespace App\Domain;

use App\Service\Components\Map\TXMapSv;

class MapDm {

  protected $_mapSv;

  public function __construct() {
  
    $this->_mapSv = new TXMapSv();
  
  }

  public function getAddress($params) {
  
    return $this->_mapSv->getQqAddress($params['address']);

  }

}
