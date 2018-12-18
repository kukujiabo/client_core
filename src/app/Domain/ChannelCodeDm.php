<?php
namespace App\Domain;

use App\Service\Admin\ChannelCodeSv;

class ChannelCodeDm {

  protected $_ccsv;

  public function __construct() {
  
    $this->_ccsv = new ChannelCodeSv();
  
  }

  public function getList($data) {
  
    return $this->_ccsv->getList($data); 
  
  }

  public function create($data) {
  
    return $this->_ccsv->create($data); 
  
  }

  public function remove($data) {
  
    return $this->_ccsv->remove($data['id']);
  
  }

  public function edit($data) {
  
    return $this->_ccsv->edit($data);
  
  }

}
