<?php
namespace App\Api;

/**
 * 商户接口
 * @desc 商户接口
 *
 * @author Meroc Chen <398515393@qq.com> 2018-04-29
 */
class Merchant extends BaseApi {

  public function getRules() {
  
    return $this->rules([
    
      'addMerchant' => [

        'mcode' => 'mcode|string|true||商户号',
        'mname' => 'mname|string|true||商家名称',
        'thumbnail' => 'thumbnail|string|true||商家头像',
        'brief' => 'brief|string|false||商家简介',
        'phone' => 'phone|string|false||商户手机号',
        'image_text' => 'image_text|string|false||商家图文详情',
        'carousel' => 'carousel|string|false||商家轮播图',
        'status' => 'status|int|false|1|商户状态'
      
      ],

      'getDetail' => [
      
        'id' => 'id|int|true||商户id',
      
      ],

      'updateMerchant' => [
      
      
      ],

      'listQuery' => [
      
        'mcode' => 'mcode|string|false||商户号',
        'mname' => 'mname|string|false||商户名称',
        'status' => 'status|int|false||商户状态',
        'order' => 'order|string|false||排序',
        'page' => 'page|int|false|1|页码',
        'page_size' => 'page_size|int|false|20|每页条数'
      
      ],

      'getAll' => [
      
        'mcode' => 'mcode|string|false||商户号',
        'mname' => 'mname|string|false||商户名称',
        'status' => 'status|int|false||商户状态',
        'order' => 'order|string|false||商户排序',
        'fields' => 'fields|string|false||商户字段'
      
      ]
    
    ]);
  
  }

  /**
   * 添加商户
   * @desc 添加商户
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
   * 更新商户
   * @desc 更新商户
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
   * 商户列表
   * @desc 商户列表
   *
   * @return array list
   */
  public function listQuery() {
  
    return $this->dm->listQuery($this->retriveRuleParams(__FUNCTION__));
  
  }

  /**
   * 获取全部商户
   * @desc 获取全部商户
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
