<?php
namespace App\Api;

/**
 * D-1 贷款接口
 *
 * @author Meroc Chen <398515393@qq.com> 2018-06-03
 */
class Reward extends BaseApi {

  public function getRules() {
  
    return $this->rules([

      'create' => [
      
        'reward_name' => 'reward_name|string|true||贷款名称',
        'reward_code' => 'reward_code|string|true||贷款编码',
        'thumbnail' => 'thumbnail|string|true||贷款图标',
        'brief' => 'brief|string|true||贷款简介',
        'material' => 'material|string|false||贷款材料',
        'institution' => 'institution|string|false||机构介绍',
        'image_text' => 'image_text|string|false||申请条件',
        'rate' => 'rate|string|true||利率',
        'min_credit' => 'min_credit|int|true||最小额度',
        'max_credit' => 'max_credit|int|true||最大额度',
        'url' => 'url|string|true||办理链接',
        'limit' => 'limit|string|false||贷款期限',
        'time' => 'time|string|true||下款时间',
        'commission' => 'commission|string|true||佣金',
        'status' => 'status|int|false||贷款状态',
        'carousel' => 'carousel|string|false||贷款轮播图',
        'start_time' => 'start_time|string|false||贷款有效期开始',
        'end_time' => 'end_time|string|false||贷款有效期结束',
        'is_self' => 'is_self|int|false|1|是否自营',
        'display_order' => 'display_order|int|false|1|排序',
        'reward_type' => 'reward_type|int|false|1|贷款佣金类型'
      
      ],

      'edit' => [
      
        'id' => 'id|int|true||id',
        'reward_name' => 'reward_name|string|false||贷款名称',
        'reward_code' => 'reward_code|string|false||贷款编码',
        'check_code' => 'check_code|string|false||核销码',
        'material' => 'material|string|false||贷款材料',
        'institution' => 'institution|string|false||机构介绍',
        'image_text' => 'image_text|string|false||申请条件',
        'rate' => 'rate|string|true||利率',
        'min_credit' => 'min_credit|int|false||最小额度',
        'max_credit' => 'max_credit|int|false||最大额度',
        'url' => 'url|string|true||办理链接',
        'limit' => 'limit|string|false||贷款期限',
        'time' => 'time|string|false||下款时间',
        'commission' => 'commission|string|false||佣金',
        'thumbnail' => 'thumbnail|string|false||贷款图标',
        'brief' => 'brief|string|false||贷款简介',
        'status' => 'status|int|false||贷款状态',
        'carousel' => 'carousel|string|false||贷款轮播图',
        'start_time' => 'start_time|string|false||贷款有效期开始',
        'end_time' => 'end_time|string|false||贷款有效期结束',
        'is_self' => 'is_self|int|false|1|是否自营',
        'display_order' => 'display_order|int|false|1|排序',
        'reward_type' => 'reward_type|int|false|1|贷款佣金类型'
      
      ],

      'listQuery' => [
      
        'shop_id' => 'shop_id|int|false||门店id',
        'reward_name' => 'reward_name|string|false||贷款名称',
        'reward_code' => 'reward_code|string|false||贷款编码',
        'status' => 'status|int|false||贷款状态',
        'fields' => 'fields|string|false||查询字段',
        'order' => 'order|string|false||排序',
        'page' => 'page|int|false||页码',
        'page_size' => 'page_size|int|false||每页条数'
      
      ],

      'getDetail' => [
      
        'id' => 'id|int|true||贷款id',
        'member_id' => 'member_id|int|false||会员id'
      
      ],

      'rewardShopUnionList' => [
      
        'member_id' => 'member_id|int|false||会员id',
        'reward_name' => 'reward_name|string|false||贷款名称',
        'shop_name' => 'shop_name|string|false||门店名称',
        'shop_id' => 'shop_id|int|false||门店id',
        'fields' => 'fields|string|false|*|字段',
        'order' => 'order|string|false|created_at desc|排序',
        'page' => 'page|int|false|1|页码',
        'page_size' => 'page_size|int|false|20|每页条数'
      
      ],

      'getAll' => [
      
        'reward_name' => 'reward_name|string|false||贷款名称',
        'reward_code' => 'reward_code|string|false||贷款编码',
        'status' => 'status|int|false||贷款状态',
        'fields' => 'fields|string|false||查询字段',
        'order' => 'order|string|false||排序',
        'page' => 'page|int|false||页码',
        'page_size' => 'page_size|int|false||每页条数'
      
      ]
    
    ]);
  
  }

  /**
   * 新建贷款
   * @desc 新建贷款
   *
   * @return int id
   */
  public function create() {
  
    return $this->dm->create($this->retriveRuleParams(__FUNCTION__)); 
  
  }

  /**
   * 更新贷款信息
   * @desc 更新贷款信息
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
   * 贷款门店关联列表
   * @desc 贷款门店关联列表
   *
   * @return array list
   */
  public function rewardShopUnionList() {
  
    return $this->dm->rewardShopUnionList($this->retriveRuleParams(__FUNCTION__));
  
  }

  /**
   * 查询全部贷款列表
   * @desc 查询全部贷款列表
   *
   * @return array list
   */
  public function getAll() {
  
    return $this->dm->getAll($this->retriveRuleParams(__FUNCTION__));
  
  }

}
