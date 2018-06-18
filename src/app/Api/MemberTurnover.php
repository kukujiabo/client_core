<?php
namespace App\Api;

/**
 * 会员资金流水接口
 *
 * @author Meroc Chen <398515393@qq.com>
 */
class MemberTurnover extends BaseApi {

  public function getRules() {
  
    return $this->rules([

      'applyCash' => [
      
        'member_id' => 'member_id|int|true||会员ID',
        'id' => 'id|int|true||流水id',
      
      ],
    
      'getList' => [
      
        'member_id' => 'member_id|int|false||会员id',
        'page' => 'page|int|false||页码',
        'page_size' => 'page_size|int|false||分页条数',
        'fields' => 'fields|int|false||字段',
        'order' => 'order|int|false||排序'
      
      ]
    
    ]);
  
  }

  /**
   * 查询资金流水列表
   * @desc 查询资金流水列表
   *
   * @return array list
   */
  public function getList() {
  
    return $this->dm->getList($this->retriveRuleParams(__FUNCTION__));
  
  }

  /**
   * 申请提现
   * @desc 申请提现
   *
   * @return 
   */
  public function applyCash() {
  
    return $this->dm->applyCash($this->retriveRuleParams(__FUNCTION__));
  
  }

}
