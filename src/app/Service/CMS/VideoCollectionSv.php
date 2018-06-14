<?php
namespace App\Service\CMS;

use App\Service\BaseService;
use Core\Service\CurdSv;

/**
 * 视频收藏服务
 *
 * @author Meroc Chen <398515393@qq.com> 2018-03-25
 */
class VideoCollectionSv extends BaseService {

  use CurdSv;

  /**
   * 查询用户收藏的视频的id
   *
   * @param int uid
   * @param string order
   * @param int page
   * @param int pageSize
   *
   * @return array
   */
  public function getUserCollectionIds($uid, $order = 'created_at desc', $page = 1, $pageSize = 10) {

    $query = [

      'member_id' => $uid, 
      
      'active' => 1
    
    ];
  
    $result = $this->queryList($query, 'video_id', $order, $page, $pageSize);
  
    return $result;
  
  }

  /**
   * 新增用户收藏
   *
   * @param int uid
   * @param int videoId
   *
   * @return int num
   */
  public function addUserCollection($uid, $videoId) {
  
    $newCollection = [
    
      'member_id' => $uid,

      'video_id' => $videoId,

      'active' => 1,

      'created_at' => date('Y-m-d H:i:s')
    
    ];

    return $this->add($newCollection);
  
  }

  /**
   * 用户取消收藏
   *
   * @param int uid
   * @param int videoId
   *
   * @return int num
   */
  public function cancelUserCollection($uid, $videoId) {

    $query = [
    
      'member_id' => $uid,

      'video_id' => $videoId,

      'active' => 1
    
    ];
  
    $collection = $this->findOne($query); 

    if ($collection) {
    
      return $this->update($collection['id'], [ 'active' => 0 ]);
    
    } else {
    
      return 0;
    
    }
  
  }

}
