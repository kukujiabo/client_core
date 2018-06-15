<?php
namespace App\Api;


/**
 * 店铺接口
 *
 * @author Meroc Chen <398515393@qq.com> 2018-06-04
 */
class Shop extends BaseApi {

  public function getRules() {
  
    return $this->rules([
    
      'create' => [
      
        'mid' => 'mid|int|true||商户id',
        'shop_name' => 'shop_name|string|true||店铺名称',
        'shop_code' => 'shop_code|string|false||店铺编码',
        'phone' => 'phone|string|false||店铺电话',
        'open_time' => 'open_time|string|false||营业时间',
        'thumbnail' => 'thumbnail|string|false||店铺logo',
        'words' => 'words|string|false||一句话介绍',
        'brief' => 'brief|string|false||店铺简介',
        'image_text' => 'image_text|string|false||店铺照片',
        'carousel' => 'carousel|string|false||店铺轮播图',
        'shop_address' => 'shop_address|string|false||门店地址',
        'latitue' => 'latitude|string|false||纬度',
        'longtitude' => 'longtitude|string|false||经度',
        'status' => 'status|int|false|1|店铺状态：1.有效，2.停用'
      
      ],

      'updateShop' => [
      
        'id' => 'id|int|true||门店id',
        'mid' => 'mid|int|false||商户id',
        'shop_name' => 'shop_name|string|false||店铺名称',
        'shop_code' => 'shop_code|string|false||店铺编码',
        'phone' => 'phone|string|true||店铺电话',
        'open_time' => 'open_time|string|true||营业时间',
        'words' => 'words|string|false||一句话介绍',
        'thumbnail' => 'thumbnail|string|false||店铺logo',
        'brief' => 'brief|string|false||店铺简介',
        'image_text' => 'image_text|string|false||店铺照片',
        'carousel' => 'carousel|string|false||店铺轮播图',
        'shop_address' => 'shop_address|string|false||门店地址',
        'status' => 'status|int|false|1|店铺状态：1.有效，2.停用'
      
      ],

      'listQuery' => [
      
        'mid' => 'mid|int|false||商户id',
        'shop_name' => 'shop_name|string|false||店铺名称',
        'shop_code' => 'shop_code|string|false||店铺编码',
        'status' => 'status|int|false||店铺状态',
        'fields' => 'fields|string|false||查询字段',
        'order' => 'order|string|false||排序',
        'page' => 'page|int|false|1|页码',
        'page_size' => 'page_size|int|false|20|每页条数'
      
      ],

      'getAll' => [
      
        'mid' => 'mid|int|false||商户id',
        'shop_name' => 'shop_name|string|false||店铺名称',
        'shop_code' => 'shop_code|string|false||店铺编码',
        'status' => 'status|int|false||店铺状态',
        'fields' => 'fields|string|false||查询字段',
        'order' => 'order|string|false||排序'
      
      ],

      'getDetail' => [
      
        'id' => 'id|int|true||门店id',
        'member_id' => 'member_id|int|false||会员id'
      
      ]
    
    ]);
  
  }

  /**
   * 新建门店
   * @desc 新建门店
   *
   * @return int id
   */
  public function create() {
  
    return $this->dm->create($this->retriveRuleParams(__FUNCTION__));  
  
  }

  /**
   * 门店列表
   * @desc 门店列表
   *
   * @return array list
   */
  public function listQuery() {
  
    return $this->dm->listQuery($this->retriveRuleParams(__FUNCTION__));
  
  }

  /**
   * 查询门店详情
   * @desc 查询门店详情
   *
   * @return array data
   */
  public function getDetail() {
  
    return $this->dm->getDetail($this->retriveRuleParams(__FUNCTION__)); 
  
  }

  /**
   * 更新门店详情
   * @desc 更新门店详情
   *
   * @return boolean true/false
   */
  public function updateShop() {
  
    $params = $this->retriveRuleParams(__FUNCTION__);

    return $this->dm->updateShop($params['id'], $params);
  
  }

  /**
   * 查询全部门店
   * @desc 查询全部门店
   *
   * @return 
   */
  public function getAll() {
  
    return $this->dm->getAll($this->retriveRuleParams(__FUNCTION__));
  
  }

}
