<?php
namespace App\Api;

/**
 * 银行数据
 *
 * @author Meroc Chen <398515393@qq.com>
 */
class BankData extends BaseApi {

  public function getRules() {

    return $this->rules([
  
      'reconciliation' => [
      
        'bank_id' => 'bank_id|int|true||银行id',
      
        'file_path' => 'file_path|string|true||文件地址',

        'orig_name' => 'orig_name|string|true||源文件名称'
      
      ]

    ]);
  
  }

  /**
   * 银行对账数据处理
   * @desc 银行对账数据处理
   *
   * @return array list
   */
  public function reconciliation() {
   
    return $this->dm->reconciliation($this->retriveRuleParams(__FUNCTION__)); 
  
  }

}
