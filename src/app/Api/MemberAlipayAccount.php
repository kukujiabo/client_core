<?php namespace App\Api;

/**
 * 会员绑定支付宝账号接口
 *
 */
class MemberAlipayAccount extends BaseApi {

  public function getRules() {
  
    return $this->rules([
    
      'create' => [
      
        'member_id' => 'member_id|int|true||会员id',

        'account' => 'account|string|true||会员账号',
      
        'real_name' => 'real_name|string|true||会员真实姓名'
      
      ],

      'getDetail' => [
      
        'member_id' => 'member_id|int|true||会员id'
      
      ]
    
    ]);
  
  }

  /**
   * 新建会员支付宝账号
   * @desc 新建会员支付宝账号
   *
   * @return int id
   */
  public function create() {
  
    return $this->dm->create($this->retriveRuleParams(__FUNCTION__)); 
  
  }

  /**
   * 查询账号详情
   * @desc 查询账号详情
   *
   * @return data array
   */
  public function getDetail() {
  
    return $this->dm->getDetail($this->retriveRuleParams(__FUNCTION__));
  
  }

}
