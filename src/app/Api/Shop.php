<?php
namespace App\Api;


/**
 * 信用卡接口
 *
 * @author Meroc Chen <398515393@qq.com> 2018-06-04
 */
class Shop extends BaseApi {

  public function getRules() {
  
    return $this->rules([
    
      'create' => [
      
        'mid' => 'mid|int|true||商户id',
        'shop_name' => 'shop_name|string|true||信用卡名称',
        'shop_code' => 'shop_code|string|false||信用卡编码',
        'phone' => 'phone|string|false||信用卡电话',
        'open_time' => 'open_time|string|false||营业时间',
        'thumbnail' => 'thumbnail|string|false||信用卡logo',
        'words' => 'words|string|false||一句话介绍',
        'ext_1' => 'ext_1|int|false||最小额度',
        'ext_2' => 'ext_2|int|false||最大额度',
        'brief' => 'brief|string|false||信用卡简介',
        'account_date' => 'account_date|int|false||结算周期',
        'image_text' => 'image_text|string|false||信用卡照片',
        'carousel' => 'carousel|string|false||信用卡轮播图',
        'commission' => 'commission|string|false||佣金',
        'audit_type' => 'audit_type|int|false||结算类型',
        'display_order' => 'display_order|int|false||排序',
        'latitue' => 'latitude|string|false||纬度',
        'longtitude' => 'longtitude|string|false||经度',
        'status' => 'status|int|false|1|信用卡状态：1.有效，2.停用'
      
      ],

      'updateShop' => [
      
        'id' => 'id|int|true||门店id',
        'mid' => 'mid|int|false||商户id',
        'shop_name' => 'shop_name|string|false||信用卡名称',
        'shop_code' => 'shop_code|string|false||信用卡编码',
        'phone' => 'phone|string|false||信用卡电话',
        'ext_1' => 'ext_1|int|false||最小额度',
        'ext_2' => 'ext_2|int|false||最大额度',
        'open_time' => 'open_time|string|false||营业时间',
        'words' => 'words|string|false||一句话介绍',
        'account_date' => 'account_date|int|false||结算周期',
        'thumbnail' => 'thumbnail|string|false||信用卡logo',
        'brief' => 'brief|string|false||信用卡简介',
        'audit_type' => 'audit_type|int|false||结算类型',
        'image_text' => 'image_text|string|false||信用卡照片',
        'carousel' => 'carousel|string|false||信用卡轮播图',
        'display_order' => 'display_order|int|false||排序',
        'commission' => 'commission|string|false||佣金',
        'status' => 'status|int|false|1|信用卡状态：1.有效，2.停用'
      
      ],

      'listQuery' => [
      
        'mid' => 'mid|int|false||商户id',
        'shop_name' => 'shop_name|string|false||信用卡名称',
        'shop_code' => 'shop_code|string|false||信用卡编码',
        'status' => 'status|int|false||信用卡状态',
        'fields' => 'fields|string|false||查询字段',
        'order' => 'order|string|false||排序',
        'page' => 'page|int|false|1|页码',
        'page_size' => 'page_size|int|false|20|每页条数'
      
      ],

      'getAll' => [
      
        'mid' => 'mid|int|false||商户id',
        'shop_name' => 'shop_name|string|false||信用卡名称',
        'shop_code' => 'shop_code|string|false||信用卡编码',
        'status' => 'status|int|false||信用卡状态',
        'fields' => 'fields|string|false||查询字段',
        'order' => 'order|string|false||排序'
      
      ],

      'getDetail' => [
      
        'id' => 'id|int|true||门店id',
        'member_id' => 'member_id|int|false||会员id'
      
      ],

      'getCardCommissionList' => [
      
        'mid' => 'mid|int|false||商户id',
        'shop_name' => 'shop_name|string|false||信用卡名称',
        'shop_code' => 'shop_code|string|false||信用卡编码',
        'status' => 'status|int|false||信用卡状态',
        'fields' => 'fields|string|false||查询字段',
        'order' => 'order|string|false||排序',
        'page' => 'page|int|false|1|页码',
        'page_size' => 'page_size|int|false|20|每页条数'
      
      
      ],

      'login' => [
      
        'account' => 'account|string|true||登录账号',

        'password' => 'password|string|true||登录密码'
      
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

  /**
   * 查询信用卡佣金列表
   * @desc 查询信用卡佣金列表
   *
   * @return
   */
  public function getCardCommissionList() {
  
    return $this->dm->getCardCommissionList($this->retriveRuleParams(__FUNCTION__)); 
  
  }

  /**
   * 店铺登录
   * @desc 店铺登录
   *
   * @return array data
   */
  public function login() {
  
    return $this->dm->login($this->retriveRuleParams(__FUNCTION__));
  
  }

}
