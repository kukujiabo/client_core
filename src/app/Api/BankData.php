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
      
        'bank_id' => 'bank_id|int|false||银行id',
        
        'channel_id' => 'channel_id|int|true||渠道id',
      
        'file_path' => 'file_path|string|true||文件地址',

        'orig_name' => 'orig_name|string|true||源文件名称'
      
      ],

      'getList' => [
      
        'mname' => 'mname|string|false||商户名称',

        'bank_id' => 'bank_id|int|true||银行id',

        'channel_id' => 'channel_id|int|false||渠道id',

        'orig_name' => 'orig_name|string|false||原始文件名',

        'fields' => 'fields|string|false||字段',

        'order' => 'order|string|false||排序',

        'page' => 'page|int|false|1|页码',

        'page_size' => 'page_size|int|false|20|每页条数'
      
      ],

      'importData' => [
      
        'id' => 'id|int|true||导入数据'
      
      ],

      'create' => [
      
        'bank_id' => 'bank_id|int|true||银行id',
        'channel_id' => 'channel_id|int|true||渠道id',
        'channel_code' => 'channel_code|string|true||渠道编码',
        'bus_date' => 'bus_date|string|true||进件日期',
        'import_num' => 'import_num|int|false|0|进件数量',
        'success_num' => 'success_num|int|false|0|核卡数量',
        'commission' => 'commission|float|false|0|佣金'
      
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

  public function importData() {
  
    return $this->dm->importData($this->retriveRuleParams(__FUNCTION__));
  
  }

  /**
   * 手动添加对账单数据
   * @desc 手动添加对账单数据
   *
   * @return int id
   */
  public function create() {
  
    return $this->dm->create($this->retriveRuleParams(__FUNCTION__));
  
  }

}
