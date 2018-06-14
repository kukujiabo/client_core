<?php
namespace App\Domain;

use App\Service\CMS\VideoCollectionSv;

/**
 * 视频处理域
 * 
 * @author Meroc Chen <398515393@qq.com> 2018-03-25
 */
class VideoCollectionDm {

  protected $_vcs;

  public function __construct() {
  
    $this->_vcs = new VideoCollectionSv();
  
  }

  /**
   * 获取用户收藏
   */
  public function getUserCollectionIds($uid, $order, $page, $pageSize) {
  
    return  $this->_vcs->getUserCollectionIds($uid, $order, $page, $pageSize);
  
  }

  /**
   * 新增用户收藏
   */
  public function addUserCollection($uid, $videoId) {
  
    return $this->_vcs->addUserCollection($uid, $videoId);
  
  }

  /**
   * 取消用户收藏
   */
  public function cancelUserCollection($uid, $videoId) {
  
    return $this->_vcs->cancelUserCollection($uid, $videoId); 
  
  }

}
