<?php
namespace App\Api;

/**
 * POS机接口
 *
 */
class YPos extends BaseApi {

  public function getRules() {
  
    return $this->rules([
    
      'create' => [
      
        'member_id' => 'member_id|int|false||会员id',
        'name' => 'name|string|false||姓名',
        'phone' => 'phone|string|false||手机号',
        'address' => 'address|string|false||地址'
      
      ],

      'getList' => [
      
        'name' => 'name|string|false||姓名',
        'phone' => 'phone|string|false||手机号',
        'page' => 'phone|string|false||页码',
        'page_size' => 'phone|string|false||每页条数'
      
      ],

      'sendPos' => [
      
        'id' => 'id|int|true||pos机发货'
      
      ],

      'getDetail' => [
      
        'member_id' => 'member_id|int|true||会员id'
      
      ]
    
    ]);
  
  }

  /**
   * 新建申请
   * @desc 新建申请
   *
   * @return int id
   */
  public function create() {
  
    return $this->dm->create($this->retriveRuleParams(__FUNCTION__));
  
  }

  /**
   * 获取申请列表
   * @desc 获取申请列表
   *
   * @return array list
   */
  public function getList() {
  
    return $this->dm->getList($this->retriveRuleParams(__FUNCTION__));
  
  }

  /**
   * pos机发货
   * @desc pos机发货
   *
   * @return int num
   */
  public function sendPos() {
  
    return $this->dm->sendPos($this->retriveRuleParams(__FUNCTION__));
  
  }

  /**
   * pos机申请详情
   * @desc pos机申请详情
   *
   * @return array data
   */
  public function getDetail() {
  
    return $this->dm->getDetail($this->retriveRuleParams(__FUNCTION__)); 
  
  }

}
