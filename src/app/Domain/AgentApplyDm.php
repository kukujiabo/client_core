<?php
namespace App\Domain;

use App\Service\Crm\AgentApplySv;

/**
 * 合作商申请
 */
class AgentApplyDm {

  protected $_aasv;

  public function __construct() {
  
    $this->_aasv = new AgentApplySv();
  
  }

  public function create($data) {
  
    return $this->_aasv->create($data);
  
  }

  public function getList($data) {
  
    return $this->_aasv->getList($data);
  
  }

  public function edit($data) {

    $id = $data['id'];

    unset($data['id']);
  
    return $this->_aasv->edit($id, $data);
  
  }

  public function getDetail($data) {
  
    return $this->_aasv->getDetail($data);
  
  }

  public function accept($data) {
  
    return $this->_aasv->accept($data);
  
  }

}
