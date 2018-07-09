<?php
namespace App\Api;

/**
 * 会员赠品接口
 *
 * @author Meroc Chen <398515393@qq.com> 2018-06-07
 */
class MemberReward extends BaseApi {

  public function getRules() {
  
    return $this->rules([
    
      'create' => [
      
        'member_id' => 'member_id|int|true||会员id',
        'reward_id' => 'reward_id|int|true||赠品id',
        'reference' => 'reference|string|true||赠品来源',
        'type' => 'type|int|true||赠品类型',
        'start_time' => 'start_time|string|false||有效起始时间',
        'end_time' => 'end_time|string|false||有效结束时间'
      
      ],

      'edit' => [
      
        'id' => 'id|int|true||会员赠品id',
        'checked' => 'checked|int|false||核销状态'
      
      ],

      'getList' => [
      
        'member_name' => 'member_name|string|false||会员名称',
        'order' => 'order|string|false|created_at desc|排序',
        'page' => 'page|int|false||页码',
        'page_size' => 'page_size|int|false||每页条数'
      
      ],

      'getInsList' => [
      
        'member_id' => 'member_id|int|false||会员id',
        'reward_id' => 'reward_id|int|false||赠品id',
        'order' => 'order|string|false|num desc|排序',
        'page' => 'page|int|false||页码',
        'page_size' => 'page_size|int|false||每页条数'
      
      ],

      'checkout' => [
      
        'member_id' => 'member_id|int|true||会员id',
        'reward_id' => 'reward_id|int|true||赠品id',
        'code' => 'code|string|true||赠品核销码',
        'num' => 'num|int|true||核销数量'
      
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
   * 编辑赠品
   * @desc 编辑赠品
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
  public function getList() {
  
    return $this->dm->getList($this->retriveRuleParams(__FUNCTION__));
  
  }

  /**
   * 会员赠品计数实例列表
   * @desc 会员赠品计数实例列表
   *
   * @return array list
   */
  public function getInsList() {
  
    return $this->dm->getInsList($this->retriveRuleParams(__FUNCTION__));
  
  }

  /**
   * 核销赠品
   * @desc 核销赠品
   *
   * @return int num
   */
  public function checkout() {
  
    return $this->dm->checkout($this->retriveRuleParams(__FUNCTION__));
  
  }

}
