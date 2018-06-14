<?php
namespace App\Api;


/**
 * 用户搜索历史接口
 *
 * @author Meroc Chen <398515393@qq.com>
 */
class SearchHistory extends BaseApi {

  public function getRules() {
  
    return $this->rules([
    
      'getMemberSearchHistory' => [
      
        'uid' => 'uid|int|true||用户id',
        'order' => 'order|string|false||排序',
        'page' => 'page|int|false||页码',
        'page_size' => 'page_size|int|false||每页条数'
      
      ],

      'addMemberSearchHistory' => [
      
        'uid' => 'uid|int|true||用户id',
        'content' => 'content|string|true||内容',
      
      ],

      'remove' => [
      
        'uid' => 'uid|int|true||删除历史查询'
      
      ],

      'removeAll' => [
      
        'uid' => 'uid|int|true||清空历史查询记录' 
      
      ]
    
    
    ]); 
  
  }

  /**
   * 获取用户查询历史列表
   * @desc 获取用户查询历史列表
   *
   * @return 
   */
  public function getMemberSearchHistory() {
  
    $params = $this->retriveRuleParams(__FUNCTION__);

    return $this->dm->getMemberSearchHistory($params['uid'], $params['order'], $params['page'], $params['page_size']);
  
  }

  /**
   * 添加用户搜索历史
   * @desc 添加用户搜索历史
   *
   * @return
   */
  public function addMemberSearchHistory() {
  
    $params = $this->retriveRuleParams(__FUNCTION__);

    return $this->dm->addMemberSearchHistory($params['uid'], $params['content']);
  
  }

  /**
   * 删除历史
   * @desc 删除历史
   *
   * @return int id
   */
  public function remove() {
  
    $params = $this->retriveRuleParams(__FUNCTION__);
  
    return $this->dm->remove($params['uid']);
  
  }

  /**
   * 清空历史
   * @desc 清空历史
   *
   * @return int num
   */
  public function removeAll() {
  
    $params = $this->retriveRuleParams(__FUNCTION__); 
  
    return $this->dm->removeAll($params['uid']);
  
  }

}
