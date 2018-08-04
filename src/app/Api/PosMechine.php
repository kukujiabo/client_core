<?php
namespace App\Api;

/**
 * pos机接口
 *
 */
class PosMechine extends BaseApi {

  public function getRules() {
  
    return $this->rules([
    
      'create' => [
      
        'pos_name' => 'pos_name|string|true||pos机名称',
        'price' => 'price|float|true||pos价格',
        'brief' => 'brief|string|true||简介',
        'pos_img' => 'pos_img|string|true||pos图片'
      
      ],

      'getList' => [
      
        'pos_name' => 'pos_name|string|false||pos机名称',
        'page' => 'page|int|false||页码',
        'page_size' => 'page_size|int|false||页码'
      
      ],

      'remove' => [
      
        'id' => 'id|int|true||pos机id'
      
      ]
    
    ]); 
  
  }

  /**
   * 创建pos机
   * @desc 创建pos机
   *
   * @return int id
   */
  public function create() {
  
    return $this->dm->create($this->retriveRuleParams(__FUNCTION__)); 
  
  }

  /**
   * 查询pos机列表
   * @desc 查询pos机列表
   *
   * @return array list
   */
  public function getList() {
  
    return $this->dm->getList($this->retriveRuleParams(__FUNCTION__)); 
  
  }

  /**
   * 删除pos机
   * @desc 删除pos机
   *
   * @return int num
   */
  public function remove() {
  
    return $this->dm->remove($this->retriveRuleParams(__FUNCTION__));
  
  }

}
