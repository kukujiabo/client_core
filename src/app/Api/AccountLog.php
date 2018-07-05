<?php
namespace App\Api;

/**
 * 会员帐户接口
 *
 */
class AccountLog extends BaseApi {

  public function getRules() {
  
    return $this->rules([
    
      'getList' => [
      
        'member_id' => 'member_id|int|true||会员id',
        'relat_id' => 'relat_id|int|false||关联id',
        'relat_type' => 'relat_type|int|false||关联类型',
        'change_type' => 'change_type|int|false||变更类型',
        'fields' => 'fields|string|false||变更类型',
        'order' => 'order|string|false||变更类型',
        'page' => 'page|int|false||页码',
        'page_size' => 'page_size|int|false||每页条数'
      
      ],

      'getUnionLogInfoList' => [
      
        'member_id' => 'member_id|int|true||会员id',
        'relat_id' => 'relat_id|int|false||关联id',
        'relat_type' => 'relat_type|int|false||关联类型',
        'change_type' => 'change_type|int|false||变更类型',
        'fields' => 'fields|string|false||变更类型',
        'order' => 'order|string|false||变更类型',
        'page' => 'page|int|false||页码',
        'page_size' => 'page_size|int|false||每页条数'
      
      ]
    
    ]);
  
  }

  /**
   * 查询账户变更记录
   * @desc 查询账户变更记录
   *
   * @return array list
   */
  public function getList() {
  
    return $this->dm->getList($this->retriveRuleParams(__FUNCTION__));  
  
  }

  /**
   * 查询账户记录详细信息列表
   * @desc 查询账户记录详细信息列表
   *
   * @return array list
   */
  public function getUnionLogInfoList() {
  
    return $this->dm->getUnionLogInfoList($this->retriveRuleParams(__FUNCTION__));
  
  }

}
