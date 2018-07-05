<?php
namespace App\Api;

/**
 * 贷款奖励规则 
 *
 * @author Meroc Chen
 */
class LoanRewardRule extends BaseApi {

  public function getRules() {
  
    return $this->rules([
    
      'create' => [
      
        'member_id' => 'member_id|int|true||会员id',
        'loan_id' => 'loan_id|int|true||贷款id',
        'senior_reward' => 'senior_reward|float|true||一级代理佣金',
        'sub_reward' => 'sub_reward|float|true||二级代理佣金',
        'remark' => 'remark|string|false||备注',
        'state' => 'state|int|false|1|状态',
      
      ],

      'getList' => [
      
        'member_id' => 'member_id|int|false||会员id',
        'loan_id' => 'loan_id|int|false||贷款id',
        'fields' => 'fields|string|false||字段',
        'order' => 'order|string|false||排序',
        'page' => 'page|int|false||页码',
        'page_size' => 'page_size|int|false||每页条数'
      
      ],

      'updateRule' => [
      
        'id' => 'id|int|true||规则id',
        'senior_reward' => 'senior_reward|float|true||一级代理佣金',
        'sub_reward' => 'sub_reward|float|true||二级代理佣金',
        'state' => 'state|int|true||状态',
        'remark' => 'remark|string|true||备注'
      
      ],

      'getRuleDetail' => [
      
        'id' => 'id|int|true||规则id'
      
      ]
    
    ]);
  
  }

  /**
   * 创建规则
   * @desc 创建规则
   *
   * @return int id
   */
  public function create() {
  
    return $this->dm->create($this->retriveRuleParams(__FUNCTION__)); 
  
  }

  /**
   * 规则列表
   * @desc 规则列表
   *
   * @return array list
   */
  public function getList() {
  
    return $this->dm->getList($this->retriveRuleParams(__FUNCTION__)); 
  
  }

  /**
   * 查询规则详情
   * @desc 查询规则详情
   *
   * @return array data
   */
  public function getRuleDetail() {
  
    return $this->dm->getRuleDetail($this->retriveRuleParams(__FUNCTION__)); 
  
  }

  /**
   * 更新规则
   * @desc 更新规则
   *
   * @return int num
   */
  public function updateRule() {
  
    return $this->dm->updateRule($this->retriveRuleParams(__FUNCTION__));
  
  }

}
