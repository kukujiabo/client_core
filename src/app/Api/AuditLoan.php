<?php
namespace App\Api;

/**
 * 小贷脱敏数据接口
 *
 * @author Meroc Chen <398515393@qq.com>
 */
class AuditLoan extends BaseApi {

  public function getRules() {
  
    return $this->rules([
    
      'getList' => [
      
        'loan_id' => 'loan_id|int|false||贷款id',

        'fields' => 'fields|string|false||字段',

        'order' => 'order|string|false||排序',

        'page' => 'page|int|false||页码',

        'page_size' => 'page_size|int|false||每页条数',
      
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


}
