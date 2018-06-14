<?php
namespace App\Api;

/**
 * 喜欢的视频
 * @desc 喜欢的视频
 *
 * @author Meroc Chen <398515393@qq.com>
 */
class VideoFavorite extends BaseApi {

  public function getRules() {

    return $this->rules([
    
      'addUserFavorVideo' => [
      
        'uid' => 'uid|int|true||用户id',

        'video_id' => 'video_id|int|true||用户id'
      
      ],

      'cancelUserFavorVideo' => [
      
        'uid' => 'uid|int|true||用户id',

        'video_id' => 'video_id|int|true||视频id'
      
      ]
    
    ]);
  
  }

  /**
   * 新增用户喜欢的视频
   * @desc 新增用户喜欢的视频
   *
   * @return
   */
  public function addUserFavorVideo() {

    $params = $this->retriveRuleParams(__FUNCTION__);
  
    return $this->dm->addUserFavorVideo($params['uid'], $params['video_id']);
  
  }

  /**
   * 取消用户喜欢的视频
   * @desc 取消用户喜欢的视频
   *
   * @return
   */
  public function cancelUserFavorVideo() {
  
    $params = $this->retriveRuleParams(__FUNCTION__);

    return $this->dm->cancelUserFavorVideo($params['uid'], $params['video_id']);

  }

}
