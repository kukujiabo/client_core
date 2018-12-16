<?php
namespace App\Api;

/**
 * 渠道码接口
 *
 */
class ChannelCode extends BaseApi {

  public function getRules() {
  
    return $this->rules([
    
      'create' => [
      
        'channel_id' => 'channel_id|int|true||渠道id',
        'bank_id' => 'bank_id|int|true||银行id',
        'channel_code' => 'channel_code|string|true||渠道码',
        'price' => 'price|float|true||单价',
      
      ],

      'getList' => [
      
        'channel_id' => 'channel_id|int|true||渠道id',
        'bank_id' => 'bank_id|int|false||银行id',
        'page' => 'page|int|false|1|页码',
        'page_size' => 'page_size|int|false|20|每页条数'
      
      ],

      'remove' => [
      
        'id' => 'id|int|true||渠道id'
      
      ]
    
    ]); 
  
  }

  /**
   * 新增渠道码
   * @desc 新增渠道码
   *
   * @return int id
   */
  public function create() {
  
    return $this->dm->create($this->retriveRuleParams(__FUNCTION__)); 
  
  }

  /**
   * 查询渠道码列表
   * @desc 查询渠道码列表
   *
   * @return array list
   */
  public function getList() {
  
    return $this->dm->getList($this->retriveRuleParams(__FUNCTION__));
  
  }

  /**
   * 删除渠道码
   * @desc 删除渠道码
   *
   * @return int id
   */
  public function remove() {
  
    return $this->dm->remove($this->retriveRuleParams(__FUNCTION__));
  
  }

}
