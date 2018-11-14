<?php
namespace App\Api;

/**
 * 脱敏数据
 *
 * @author 
 */
class AuditCard extends BaseApi {

  public function getRules() {
  
    return $this->rules([
    
      'getList' => [
      
        'sequence' => 'sequence|string|false||流水号',
        'source' => 'sequence|string|source||渠道号',
        'bank_id' => 'bank_id|int|false||银行id',
        'order' => 'order|string|false||排序',
        'fields' => 'fields|string|false||字段',
        'page' => 'page|int|false||页码',
        'page_size' => 'page_size|int|false|50|每页条数'
      
      ],

      'balanceOfAccount' => [
      
        'sequence' => 'sequence|string|false||流水号',
        'bank_id' => 'bank_id|int|false||银行id'
      
      ]
    
    ]);
  
  }

  
  /**
   * 查询列表
   * @desc 查询列表
   *
   * @return array list
   */
  public function getList() {
  
    return $this->dm->getList($this->retriveRuleParams(__FUNCTION__));
  
  }

  /**
   * 对账
   * @desc 对账
   *
   * @return array result
   */
  public function balanceOfAccount() {
  
    return $this->dm->balanceOfAccount($this->retriveRuleParams(__FUNCTION__));
  
  }

}
