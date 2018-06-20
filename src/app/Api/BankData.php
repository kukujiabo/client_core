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
      
      ],

      'getList' => [
      
        'mname' => 'mname|string|false||商户名称',

        'orig_name' => 'orig_name|string|false||原始文件名',

        'fields' => 'fields|string|false||字段',

        'order' => 'order|string|false||排序',

        'page' => 'page|int|false|1|页码',

        'page_size' => 'page_size|int|false|20|每页条数'
      
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

  public function getList() {
  
    return $this->dm->getList($this->retriveRuleParams(__FUNCTION__));
  
  }

}
