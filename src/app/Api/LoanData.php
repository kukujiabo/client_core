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

}
