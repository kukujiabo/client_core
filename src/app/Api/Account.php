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
      
      ],

      'getList' => [
      
        'member_name' => 'member_name|string|false||会员名称',
        'alipay_account' => 'alipay_account|string|false||支付宝账号',
        'alipay_realname' => 'alipay_realname|string|false||支付宝实名',
        'member_type' => 'member_type|int|false||会员等级',
        'page' => 'page|int|false||页码',
        'page_size' => 'page_size|int|false||每页条数',
        'order' => 'order|string|false||排序',
        'fields' => 'fields|string|false||字段',
      
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

  /**
   * 查询账户列表
   * @desc 查询账户列表
   *
   * @return array data
   */
  public function getList() {
  
    return $this->dm->getList($this->retriveRuleParams(__FUNCTION__));
  
  }

}
