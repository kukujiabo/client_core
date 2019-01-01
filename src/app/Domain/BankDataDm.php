<?php
namespace App\Domain;

use App\Service\Merchant\BankDataSv;

class BankDataDm {

  protected $_bdsv;

  public function __construct() {
  
    $this->_bdsv = new BankDataSv();
  
  }

  public function reconciliation($data) {
  
    return $this->_bdsv->reconciliation($data); 
  
  }

  public function getList($data) {
  
    return $this->_bdsv->getList($data);
  
  }

  public function importData($data) {
  
    return $this->_bdsv->importData($data);
  
  }

  public function create($data) {
  
    return $this->_bdsv->create($data);
  
  }

  public function getDetail($data) {

    return $this->_bdsv->findOne($data['id']);

  }

  public function update($data) {

    return $this->_bdsv->update($data['id'], [ 'download' => 1 ]);

  }

  public function remove($data) {

    return $this->_bdsv->remove($data['id']);

  }

}
