<?php
namespace App\Domain;

use App\Service\CMS\SearchHistorySv;

/**
 * 用户搜索历史
 */
class SearchHistoryDm {

  protected $_shsv;

  public function __construct() {
  
    $this->_shsv = new SearchHistorySv();
  
  }

  /**
   * 添加用户搜索历史
   */
  public function addMemberSearchHistory($uid, $content) {
  
    return $this->_shsv->addMemberSearchHistory($uid, $content);
  
  }

  /**
   * 查询用户搜索历史
   */
  public function getMemberSearchHistory($uid, $order, $page, $pageSize) {
  
    return $this->_shsv->getMemberSearchHistory($uid, $order, $page, $pageSize);
  
  }

  /**
   * 删除用户搜索历史
   */
  public function remove($id) {
  
    return $this->_shsv->remove($id);
  
  }

  /**
   * 清空用户搜索历史
   */
  public function removeAll($uid) {
  
    return $this->_shsv->batchRemove([ 'member_id' => $uid ]);
  
  }

}
