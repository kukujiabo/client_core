<?php
namespace App\Api;

/**
 * D-1 赠品接口
 *
 * @author Meroc Chen <398515393@qq.com> 2018-06-03
 */
class Reward extends BaseApi {

  public function getRules() {
  
    return $this->rules([

      'create' => [
      
        'reward_name' => 'reward_name|string|true||赠品名称',
        'reward_code' => 'reward_code|string|true||赠品编码',
        'check_code' => 'check_code|string|true||核销码',
        'price' => 'price|float|true||赠品价格',
        'thumbnail' => 'thumbnail|string|true||赠品图标',
        'brief' => 'brief|string|true||赠品简介',
        'shop_id' => 'shop_id|int|true||赠品所属门店',
        'status' => 'status|int|false||赠品状态',
        'carousel' => 'carousel|string|false||赠品轮播图',
        'start_time' => 'start_time|string|false||赠品有效期开始',
        'end_time' => 'end_time|string|false||赠品有效期结束'
      
      ],

      'edit' => [
      
        'id' => 'id|int|true||id',
        'reward_name' => 'reward_name|string|false||赠品名称',
        'reward_code' => 'reward_code|string|false||赠品编码',
        'check_code' => 'check_code|string|false||核销码',
        'price' => 'price|float|false||赠品价格',
        'thumbnail' => 'thumbnail|string|false||赠品图标',
        'brief' => 'brief|string|false||赠品简介',
        'shop_id' => 'shop_id|int|false||赠品所属门店',
        'status' => 'status|int|false||赠品状态',
        'carousel' => 'carousel|string|false||赠品轮播图',
        'start_time' => 'start_time|string|false||赠品有效期开始',
        'end_time' => 'end_time|string|false||赠品有效期结束'
      
      
      ],

      'listQuery' => [
      
        'shop_id' => 'shop_id|int|false||门店id',
        'reward_name' => 'reward_name|string|false||赠品名称',
        'reward_code' => 'reward_code|string|false||赠品编码',
        'status' => 'status|int|false||赠品状态',
        'fields' => 'fields|string|false||查询字段',
        'order' => 'order|string|false||排序',
        'page' => 'page|int|false||页码',
        'page_size' => 'page_size|int|false||每页条数'
      
      ],

      'getDetail' => [
      
        'id' => 'id|int|true||赠品id',
        'member_id' => 'member_id|int|false||会员id'
      
      ],

      'rewardShopUnionList' => [
      
        'member_id' => 'member_id|int|false||会员id',
        'reward_name' => 'reward_name|string|false||赠品名称',
        'shop_name' => 'shop_name|string|false||门店名称',
        'shop_id' => 'shop_id|int|false||门店id',
        'fields' => 'fields|string|false|*|字段',
        'order' => 'order|string|false|created_at desc|排序',
        'page' => 'page|int|false|1|页码',
        'page_size' => 'page_size|int|false|20|每页条数'
      
      ]
    
    ]);
  
  }

  /**
   * 新建赠品
   * @desc 新建赠品
   *
   * @return int id
   */
  public function create() {
  
    return $this->dm->create($this->retriveRuleParams(__FUNCTION__)); 
  
  }

  /**
   * 更新赠品信息
   * @desc 更新赠品信息
   *
   * @return int num
   */
  public function edit() {
  
    return $this->dm->edit($this->retriveRuleParams(__FUNCTION__));
  
  }

  /**
   * 查询列表
   * @desc 查询列表
   *
   * @return array list
   */
  public function listQuery() {
  
    return $this->dm->listQuery($this->retriveRuleParams(__FUNCTION__));
  
  }

  /**
   * 查询详情
   * @desc 查询详情
   *
   * @return array data
   */
  public function getDetail() {
  
    return $this->dm->getDetail($this->retriveRuleParams(__FUNCTION__));
  
  }

  /**
   * 赠品门店关联列表
   * @desc 赠品门店关联列表
   *
   * @return array list
   */
  public function rewardShopUnionList() {
  
    return $this->dm->rewardShopUnionList($this->retriveRuleParams(__FUNCTION__));
  
  }

}
