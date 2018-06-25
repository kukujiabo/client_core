<?php
namespace App\Api;

/**
 * 推广奖励规则
 *
 * @author Meroc Chen
 */
class RewardRule extends BaseApi {

  public function getRules() {
  
    return $this->rules([
    
      'create' => [
      
        'member_id' => 'member_id|int|true||会员id',
        'card_id' => 'card_id|int|true||信用卡id',
        'senior_reward' => 'senior_reward|float|true||一级奖励金',
        'sub_reward' => 'sub_reward|float|true||下级奖励金'
      
      ],

      'getList' => [
      
        'member_name' => 'member_name|string|false||会员名称',
        'card_id' => 'card_id|int|false||信用卡id',
        'fields' => 'fields|string|false||字段',
        'order' => 'order|string|false||排序',
        'page' => 'page|int|false||页码',
        'page_size' => 'page_size|int|false||每页条数'
      
      ]
    
    ]);
  
  }

  public function create() {

    return $this->dm->create($this->retriveRuleParams(__FUNCTION__));
  
  }

  public function getList() {
  
    return $this->dm->getList($this->retriveRuleParams(__FUNCTION__));
  
  }

}
