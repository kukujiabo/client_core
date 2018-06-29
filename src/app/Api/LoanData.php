<?php
namespace App\Api;

/**
 * 贷款数据
 *
 * @author Meroc Chen <398515393@qq.com>
 */
class LoanData extends BaseApi {

  public function getRules() {
  
    return $this->rules([
    
      'reconciliation' => [
      
        'loan_id' => 'loan_id|int|true||贷款id',

        'file_path' => 'file_path|string|true||文件位置',

        'orig_name' => 'orig_name|string|true||文件原名'
      
      ],

      'getList' => [
      
        'reward_name' => 'reward_name|string|false||贷款名称',

        'orig_name' => 'orig_name|string|false||原始文件名',

        'fields' => 'fields|string|false||字段',

        'order' => 'order|string|false||排序',

        'page' => 'page|int|false|1|页码',

        'page_size' => 'page_size|int|false|20|每页条数'
      
      ]
    
    ]);
  
  }

  /**
   * 贷款对账数据
   * @desc 贷款对账数据
   *
   * @return array data
   */
  public function reconciliation() {
  
    return $this->dm->reconciliation($this->retriveRuleParams(__FUNCTION__));  
  
  }

  /**
   * 查询贷款文件列表
   * @desc 查询贷款文件列表
   *
   * @return array list
   */
  public function getList() {
  
    return $this->dm->getList($this->retriveRuleParams(__FUNCTION__));
  
  }

}
