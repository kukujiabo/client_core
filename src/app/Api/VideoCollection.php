<?php
namespace App\Api;

/**
 * 用户收藏视频接口
 *
 * @author Meroc Chen <398515393@qq.com> 2018-03-25
 */
class VideoCollection extends BaseApi {

  public function getRules() {
  
    return $this->rules([
    
      'addUserCollection' => [
      
        'uid' => 'uid|int|true||用户id',

        'video_id' => 'video_id|int|true||视频id'
      
      ],

      'cancelUserCollection' => [

        'uid' => 'uid|int|true||用户id',

        'video_id' => 'video_id|int|true||视频id'
      
      ],

      'getUserCollectionIds' => [
      
        'uid' => 'uid|int|true||用户id',

        'order' => 'order|string|false||排序',

        'page' => 'page|int|false|1|页码',

        'page_size' => 'page_size|int|false|10|每页条数'
      
      ]
    
    
    ]);
  
  }

  /**
   * 添加用户收藏
   * @desc 添加用户收藏
   *
   * @return int num
   */
  public function addUserCollection() {
  
    $params = $this->retriveRuleParams(__FUNCTION__);

    return $this->dm->addUserCollection($params['uid'], $params['video_id']);
  
  }

  /**
   * 用户取消收藏
   * @desc 用户取消收藏
   *
   * @return array
   */
  public function cancelUserCollection() {
  
    $params = $this->retriveRuleParams(__FUNCTION__);

    return $this->dm->cancelUserCollection($params['uid'], $params['video_id']);
  
  }

  /**
   * 获取用户收藏
   * @desc 获取用户收藏
   *
   * @return array 
   */
  public function getUserCollectionIds() {
  
    $params = $this->retriveRuleParams(__FUNCTION__);
  
    return $this->dm->getUserCollectionIds($params['uid'], $params['order'], $params['page'], $params['page_size']);
  
  }


}
