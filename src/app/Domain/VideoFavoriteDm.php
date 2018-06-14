<?php
namespace App\Domain;

use App\Service\CMS\VideoFavoriteSv;

/**
 * 喜欢的视频处理域
 *
 * @author Meroc Chen
 */
class VideoFavoriteDm {

  protected $_vfsv;

  public function __construct() {
  
    $this->_vfsv = new VideoFavoriteSv();
  
  }

  /**
   * 新增用户喜欢的视频
   */
  public function addUserFavorVideo($uid, $videoId) {

    return $this->_vfsv->addUserFavorVideo($uid, $videoId);

  }

  /**
   * 取消用户喜欢的视频
   */
  public function cancelUserFavorVideo($uid, $videoId) {
  
    return $this->_vfsv->cancelUserFavorVideo($uid, $videoId);
  
  }

}
