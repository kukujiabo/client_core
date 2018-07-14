<?php
namespace App\Api;

/**
 * 提现接口
 * @desc 提现接口
 *
 * @author Meroc Chen
 */
class CashApply extends BaseApi {

  public function getRules() {
  
    return $this->rules([

      'create' => [
    
        'member_id' => 'member_id|int|true||会员id',

        'cash' => 'cash|float|true||会员id'

      ],

      'getList' => [
      
        'member_name' => 'member_name|string|false||会员名称',
        'alipay_account' => 'alipay_account|string|false||支付宝账号',
        'alipay_realname' => 'alipay_realname|string|false||支付宝实名',
        'fields' => 'fields|string|false||字段',
        'order' => 'order|string|false||排序',
        'page' => 'page|int|false||页码',
        'page_size' => 'page_size|int|false||每页条数'
      
      ]
    
    ]);
  
  }

  /**
   * 新建提现申请
   * @desc 新建提现申请
   *
   * @return int id
   */
  public function create() {
  
    return $this->dm->create($this->retriveRuleParams(__FUNCTION__));
  
  }

  /**
   * 查询申请列表
   * @desc 查询申请列表
   *
   * @return array list
   */
  public function getList() {
  
    return $this->dm->getList($this->retriveRuleParams(__FUNCTION__));
  
  }


}
