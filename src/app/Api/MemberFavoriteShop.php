<?php
namespace App\Api;

/**
 * 会员关注店铺接口
 *
 * @author Meroc Chen <398515393@qq.com> 
 */
class MemberFavoriteShop extends BaseApi {

  public function getRules() {
  
    return $this->rules([
    
      'create' => [
      
        'member_id' => 'member_id|int|true||会员id',
        'shop_id' => 'shop_id|int|true||门店id'
      
      ],

      'cancelFocus' => [
      
        'id' => 'id|int|true||关注id号'
      
      ],

      'getUnionInfoList' => [
      
        'member_id' => 'member_id|int|false||会员id',
        'shop_id' => 'shop_id|int|false||门店id',
        'focus' => 'focus|int|false||关注状态',
        'fields' => 'fields|int|false||字段',
        'order' => 'fields|int|false||排序',
        'page' => 'page|int|false||页码',
        'page_size' => 'page_size|int|false||每页条数'
      
      ],
    
      'getFocusCount' => [
      
        'member_id' => 'member_id|int|false||会员id',
        'shop_id' => 'shop_id|int|false||门店id',
        'focus' => 'focus|int|false||关注状态'

      ]
    
    ]);
  
  }

  /**
   * 新增关注
   * @desc 新增关注
   *
   * @return int id
   */
  public function create() {
  
    return $this->dm->create($this->retriveRuleParams(__FUNCTION__));
  
  }

  /**
   * 取消关注
   * @desc 取消关注
   *
   * @return int num
   */
  public function cancelFocus() {
  
    return $this->dm->cancelFocus($this->retriveRuleParams(__FUNCTION__));
  
  }

  /**
   * 查询关注列表
   * @desc 查询关注列表
   *
   * @return array list
   */
  public function getUnionInfoList() {
  
    return $this->dm->getUnionInfoList($this->retriveRuleParams(__FUNCTION__));
  
  }

  /**
   * 查询关注数量
   * @desc 查询关注数量
   *
   * @return int num
   */
  public function getFocusCount() {
  
    return $this->dm->getFocusCount($this->retriveRuleParams(__FUNCTION__));
  
  }

}
