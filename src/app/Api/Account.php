<?php
namespace App\Api;

/**
 * 账户接口
 *
 *
 */
class Account extends BaseApi {

  public function getRules() {
  
    return $this->rules([
    
      'getDetail' => [
      
        'member_id' => 'member_id|int|true||会员id'
      
      ]
    
    
    ]);
  
  }

  /**
   * 查询账户详情
   * @desc 查询账户详情
   *
   * @return array data
   */
  public function getDetail() {
  
    return $this->dm->getDetail($this->retriveRuleParams(__FUNCTION__));
  
  }

}
