<?php
namespace App\Api;

/**
 * 视频内容接口
 *
 * @author Meroc Chen <398515393@qq.com> 2018-02-12
 */
class Video extends BaseApi {

  public function getRules() {
  
    return $this->rules([
    
      'addVideo' => [
      
        'out_id' => 'out_id|string|true||第三方平台id',

        'member_id' => 'member_id|int|true||用户id',

        'author_id' => 'author_id|int|true||作者id',

        'category_id' => 'category_id|string|true||分类id',

        'cover' => 'cover|string|true||视频封面',

        'album_id' => 'album_id|int|true||相册id',

        'title' => 'title|string|true||视频标题',

        'brief' => 'brief|string|true||视频简介',

        'url' => 'url|string|true||视频链接地址',

        'introduction' => 'introduction|string|false||视频图文信息',

        'duration' => 'duration|string|true||视频时长',

        'sort' => 'sort|int|false||视频排序',

        'status' => 'status|int|true||视频状态'
      
      ],

      'editVideo' => [
      
        'id' => 'id|int|true||视频id',

        'out_id' => 'out_id|int|false||第三方平台id',

        'category_id' => 'category_id|int|false||分类id',

        'cover' => 'cover|string|false||视频封面',

        'album_id' => 'album_id|int|false||专辑id',

        'title' => 'title|string|false||视频标题',

        'brief' => 'brief|string|false||视频简介',

        'url' => 'url|string|false||视频链接地址',

        'introduction' => 'introduction|string|false||视频图文信息',

        'duration' => 'duration|string|false||视频时长',

        'status' => 'status|int|false||视频状态',

        'sort' => 'sort|int|false||视频排序'
      
      ],

      'listQuery' => [
      
        'out_id' => 'out_id|string|false||第三方品台视频id',

        'member_id' => 'member_id|int|false||用户id',

        'category_id' => 'category_id|int|false||分类id',

        'album_id' => 'album_id|int|false||相册id',

        'keyword' => 'keyword|string|false||关键字',

        'status' => 'status|int|false||视频状态',

        'created_at' => 'created_at|string|false||创建时间',

        'times' => 'times|string|false||时间戳',

        'order' => 'order|int|false|id desc|排序',

        'all' => 'all|int|false|0|是否全部加载',

        'sort' => 'sort|int|false||视频排序',

        'page' => 'page|int|false|1|页码',

        'page_size' => 'page_size|int|false|20|分页数量',
      
      ],

      'detail' => [

        'uid' => 'uid|int|false||用户id',
      
        'id' => 'id|int|true||视频id'
      
      ],

      'remove' => [
      
        'id' => 'id|int|true||视频id'
      
      ],

      'getUserCollectVideos' => [
      
        'uid' => 'uid|int|true||用户id',

        'order' => 'order|string|false||排序',

        'page' => 'page|int|false|1|页码',

        'page_size' => 'page_size|int|false|15|每页数据数量'
      
      ],

      'getUserFavoriteVideos' => [
      
        'uid' => 'uid|int|true||用户id',

        'order' => 'order|string|false||排序',

        'page' => 'page|int|false|1|页码',

        'page_size' => 'page_size|int|false|15|每页数据数量'
      
      ]
    
    ]);
  
  }

  /**
   * 添加视频
   * @desc 添加视频
   *
   * @return boolean true/false
   */
  public function addVideo() {
  
    $params = $this->retriveRuleParams(__FUNCTION__);
  
    return $this->dm->addVideo(
      $params['out_id'],
      $params['author_id'],
      $params['member_id'],
      $params['category_id'],
      $params['cover'],
      $params['album_id'],
      $params['title'],
      $params['brief'],
      $params['introduction'],
      $params['url'],
      $params['status'],
      $params['duration']
    );
  
  }

  /**
   * 更新视频信息
   * @desc 更新视频信息
   *
   * @return int 视频更新信息
   */
  public function editVideo() {
  
    $params = $this->retriveRuleParams(__FUNCTION__); 

    return $this->dm->editVideo(
      $params['id'],
      $params['out_id'],
      $params['category_id'],
      $params['album_id'],
      $params['cover'],
      $params['title'],
      $params['brief'],
      $params['introduction'],
      $params['url'],
      $params['status'],
      $params['duration']
    );
  
  }

  /**
   * 查询视频列表
   * @desc 查询视频列表
   *
   * @return array/null 视频列表，查询失败返回null
   */
  public function listQuery() {
  
    $params = $this->retriveRuleParams(__FUNCTION__);
  
    return $this->dm->listQuery(
      $params['out_id'],
      $params['member_id'],
      $params['category_id'],
      $params['album_id'],
      $params['keyword'],
      $params['status'],
      $params['sort'],
      $params['times'],
      $params['order'],
      $params['all'],
      $params['page'],
      $params['page_size']
    );
  }

  /**
   * 查询视频详情
   * @desc 查询视频详情
   *
   * @return array 
   */
  public function detail() {

    $params = $this->retriveRuleParams(__FUNCTION__); 

    return $this->dm->detail($params['uid'], $params['id']);
  
  }

  /**
   * 删除视频
   * @desc 删除视频
   *
   * @return int num
   */
  public function remove() {
  
    $params = $this->retriveRuleParams(__FUNCTION__);

    return $this->dm->remove($params['id']);
  
  }

  /**
   * 获取用户收藏的视频列表
   * @desc 用户收藏视频
   *
   * @return 
   */
  public function getUserCollectVideos() {
  
    $params = $this->retriveRuleParams(__FUNCTION__); 

    return $this->dm->getUserCollectVideos($params['uid'], $params['order'], $params['page'], $params['page_size']);
  
  }

  /**
   * 获取用户喜欢的视频列表
   * @desc 获取用户喜欢的视频
   *
   * @return
   */
  public function getUserFavoriteVideos() {
   
    $params = $this->retriveRuleParams(__FUNCTION__);
  
    return $this->dm->getUserFavoriteVideos($params['uid'], $params['order'], $params['page'], $params['page_size']);
  
  }

}
