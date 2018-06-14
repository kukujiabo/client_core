<?php
namespace App\Api;

/**
 * 分享动作接口
 *
 * @author Meroc Chen <398515393@qq.com>
 */
class ShareAction extends BaseApi {

  public function getRules() {
  
    return $this->rules([
    
      'create' => [
      
        'member_id' => 'member_id|int|true||会员id',
        'share_code' => 'share_code|string|true||分享码',
        'type' => 'type|int|true||分享类型：1.分享怎平，2.分享小程序',
        'relat_id' => 'relat_id|int|true||分享id'
      
      ],

      'listQuery' => [
      
        'member_name' => 'member_name|string|false||会员名称',
        'reward_name' => 'reward_name|string|false||赠品名称',
        'share_code' => 'share_code|string|false||分享码'
      
      ], 

      'getGift' => [
      
        'member_id' => 'member_id|int|true||被赠送人id',
        'share_code' => 'share_code|string|true||分享编号'
      
      ],

      'getDetail' => [
      
        'id' => 'id|int|false||分享id',
        'share_code' => 'share_code|string|false||分享编码'
      
      ]
    
    ]);
  
  }

  /**
   * 创建分享动作
   * @desc 创建分享动作
   *
   * @return int id
   */
  public function create() {
  
    return $this->dm->create($this->retriveRuleParams(__FUNCTION__));
  
  }

  /**
   * 会员分享动作列表
   * @desc 会员分享动作列表
   *
   * @return array list
   */
  public function listQuery() {
  
    return $this->dm->listQuery($this->retriveRuleParams(__FUNCTION__));
  
  }

  /**
   * 领取赠品
   * @desc 领取赠品
   *
   * @return int id
   */
  public function getGift() {
  
    return $this->dm->getGift($this->retriveRuleParams(__FUNCTION__)); 
  
  }

  /**
   * 查询分享赠品详情
   * @desc 查询分享赠品详情
   *
   * @return array data
   */
  public function getDetail() {
  
    return $this->dm->getDetail($this->retriveRuleParams(__FUNCTION__));
  
  }

}
