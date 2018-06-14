<?php
namespace App\Service\CMS;

use App\Service\BaseService;
use Core\Service\CurdSv;

/**
 * 视频搜索历史服务
 *
 * @author Meroc Chen <398515393@qq.com>
 */
class SearchHistorySv extends BaseService {

  use CurdSv;

  /**
   * 获取会员查询历史
   *
   * @param int uid
   *
   * @return
   */
  public function getMemberSearchHistory($uid, $order, $page = 1, $pageSize = 100) {

    $history = $this->queryList([ 'member_id' => $uid ], '*', $order, $page, $pageSize);

    $returnData = [];

    foreach($history['list'] as $h) {
    
      if (!in_array($h['content'], $returnData)) {
      
        array_push($returnData, $h['content']);
      
      }
    
    }

    return $returnData;
  
  }

  /**
   * 添加用户搜索历史
   *
   * @param int uid
   * @param string content
   *
   * @return int id
   */
  public function addMemberSearchHistory($uid, $content) {
  
    $newHis = [
    
      'member_id' => $uid,

      'content' => $content,

      'created_at' => date('Y-m-d H:i:s')
    
    ];

    return $this->add($newHis);
  
  }

}
