<?php
namespace App\Api;

/**
 * 银行接口
 * @desc 银行接口
 *
 * @author Meroc Chen <398515393@qq.com> 2018-04-29
 */
class Merchant extends BaseApi {

  public function getRules() {
  
    return $this->rules([
    
      'addMerchant' => [

        'mcode' => 'mcode|string|true||银行号',
        'mname' => 'mname|string|true||商家名称',
        'thumbnail' => 'thumbnail|string|true||商家头像',
        'brief' => 'brief|string|false||商家简介',
        'process_url' => 'process_url|string|false||信用卡进度查询链接',
        'phone' => 'phone|string|false||银行手机号',
        'image_text' => 'image_text|string|false||商家图文详情',
        'carousel' => 'carousel|string|false||商家轮播图',
        'status' => 'status|int|false|1|银行状态'
      
      ],

      'getDetail' => [
      
        'id' => 'id|int|true||银行id',
      
      ],

      'updateMerchant' => [
      
        'id' => 'id|int|true||银行id',
        'mname' => 'mname|string|false||商家名称',
        'thumbnail' => 'thumbnail|string|false||商家头像',
        'brief' => 'brief|string|false||商家简介',
        'process_url' => 'process_url|string|false||信用卡进度查询链接',
        'phone' => 'phone|string|false||银行手机号',
        'image_text' => 'image_text|string|false||商家图文详情',
        'carousel' => 'carousel|string|false||商家轮播图',
        'status' => 'status|int|false|1|银行状态'
      
      ],

      'listQuery' => [
      
        'mcode' => 'mcode|string|false||银行号',
        'mname' => 'mname|string|false||银行名称',
        'status' => 'status|int|false||银行状态',
        'order' => 'order|string|false||排序',
        'page' => 'page|int|false|1|页码',
        'page_size' => 'page_size|int|false|20|每页条数'
      
      ],

      'getAll' => [
      
        'mcode' => 'mcode|string|false||银行号',
        'mname' => 'mname|string|false||银行名称',
        'status' => 'status|int|false||银行状态',
        'order' => 'order|string|false||银行排序',
        'fields' => 'fields|string|false||银行字段'
      
      ]
    
    ]);
  
  }

  /**
   * 添加银行
   * @desc 添加银行
   *
   * @param array data
   *
   * @return int id
   */
  public function addMerchant() {

    $data = $this->retriveRuleParams(__FUNCTION__);
  
    return $this->dm->addMerchant($data);
  
  }

  /**
   * 更新银行
   * @desc 更新银行
   *
   * @param int id
   * @param array data
   *
   * @return int num
   */
  public function updateMerchant() {

    $data = $this->retriveRuleParams(__FUNCTION__);

    $id = $data['id'];

    unset($data['id']);
  
    return $this->dm->updateMerchant($id, $data);
  
  }

  /**
   * 银行列表
   * @desc 银行列表
   *
   * @return array list
   */
  public function listQuery() {
  
    return $this->dm->listQuery($this->retriveRuleParams(__FUNCTION__));
  
  }

  /**
   * 获取全部银行
   * @desc 获取全部银行
   *
   * @return array list
   */
  public function getAll() {
  
    return $this->dm->getAll($this->retriveRuleParams(__FUNCTION__));
  
  }

  /**
   * 查询详情接口
   * @desc 查询详情接口
   *
   * @return array data
   */
  public function getDetail() {
  
    return $this->dm->getDetail($this->retriveRuleParams(__FUNCTION__));
  
  }

}
