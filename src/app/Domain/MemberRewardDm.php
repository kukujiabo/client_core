<?php
namespace App\Domain;

use App\Service\Commodity\MemberRewardSv;

class MemberRewardDm {

  protected $_mrs;

  public function __construct() {
  
    $this->_mrs= new MemberRewardSv();
  
  }

  /**
   * 新建对象
   */
  public function create($data) {
  
    return $this->_mrs->create($data);
  
  }

  /**
   * 编辑对象
   */
  public function edit($data) {
  
    return $this->_mrs->edit($data);
  
  }

  /**
   * 查询列表
   */
  public function getList($data) {
  
    return $this->_mrs->getList($data);
  
  }

  /**
   * 
   */
  public function getInsList($data) {
  
    return $this->_mrs->getInsList($data); 
  
  }

  /**
   * 核销
   */
  public function checkout($data) {
  
    return $this->_mrs->checkout($data);
  
  }

}
