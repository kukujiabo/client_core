<?php
namespace App\Domain;

use App\Service\CMS\VideoSv;
use App\Service\CMS\VideoCollectionSv;
use App\Service\CMS\VideoFavoriteSv;

/**
 * 视频服务域
 *
 * @author Meroc Chen <398515393@qq.com> 2018-02-12
 */
class VideoDm {

  protected $_vsv;

  protected $_vcsv;

  protected $_vfsv;

  public function __construct() {
  
    $this->_vsv = new VideoSv();

    $this->_vcsv = new VideoCollectionSv();

    $this->_vfsv = new VideoFavoriteSv();
  
  }

  /**
   * 添加视频
   *
   * @param int outId
   * @param int memberId
   * @param int categoryId
   * @param int albumId
   * @param int title
   * @param int brief
   * @param int url
   *
   * @return 
   */
  public function addVideo($outId, $authorId, $memberId, $categoryId, $cover, $albumId, $title, $brief, $introduction, $url, $status, $duration, $sort) {
  
    return $this->_vsv->addVideo($outId, $authorId, $memberId, $categoryId, $cover, $albumId, $title, $brief, $introduction, $url, $status, $duration, $sort);
  
  }

  /**
   * 编辑视频信息
   *
   * @param int id
   * @param array videoInfo
   * @param int videoInfo.category_id
   * @param int videoInfo.album_id
   * @param string videoInfo.title
   * @param string videoInfo.brief
   * @param string videoInfo.cover
   * @param int videoInfo.status
   *
   * @return boolean true/false
   */
  public function editVideo($id, $outId, $categoryId, $albumId, $cover, $title, $brief, $introduction, $url, $status, $duration, $sort) {

    $data = [];

    if (isset($outId)) $data['out_id'] = $outId;
    if (isset($categoryId)) $data['category_id'] = $categoryId;
    if (isset($albumId)) $data['album_id'] = $albumId;
    if (isset($cover)) $data['cover'] = $cover;
    if (isset($title)) $data['title'] = $title;
    if (isset($brief)) $data['brief'] = $brief;
    if (isset($introduction)) $data['brief'] = $introduction;
    if (isset($url)) $data['url'] = $url;
    if (isset($status)) $data['status'] = $status;
    if (isset($duration)) $data['duration'] = $duration;
    if (isset($sort)) $data['sort'] = $sort;

    return $this->_vsv->editVideo($id, $data);
  
  }

  /**
   * 查询视频列表
   *
   * @param string outId
   * @param int memberId
   * @param int categoryId
   * @param int albumId
   * @param string keyword
   * @param int status
   * @param string order
   * @param int page
   * @param int pageSize
   *
   * @return
   */
  public function listQuery($outId, $memberId, $categoryId, $albumId, $keyword, $status, $sort, $times, $order, $all, $page, $pageSize) {
  
    return $this->_vsv->listQuery($outId, $memberId, $categoryId, $albumId, $keyword, $status, $sort, $times, $order, $all, $page, $pageSize); 
  
  }

  /**
   * 查询视频详情
   *
   * @param int id
   *
   * @return array 
   */
  public function detail($uid, $id) {
  
    return $this->_vsv->detail($uid, $id);
  
  }

  /**
   * 删除视频
   *
   * @param int id
   *
   * @return int num
   */
  public function remove($id) {
  
    return $this->_vsv->remove($id);
  
  }

  /**
   * 查询用户收藏的视频
   *
   * @param int uid
   *
   * @return array list
   */
  public function getUserCollectVideos($uid, $order, $page, $pageSize) {
  
    $vids = $this->_vcsv->getUserCollectionIds($uid, $order, $page, $pageSize);

    $idArr = [];

    foreach($vids['list'] as $vid) {
    
      array_push($idArr, $vid['video_id']);
    
    }

    $videos = $this->_vsv->addVideoCategoryField($this->_vsv->all([ 'id' => implode(',', $idArr) ]));

    $sortVideos = [];

    foreach($idArr as $id) {
    
      foreach($videos as $video) {
      
        if ($id == $video['id']) {
        
          array_push($sortVideos, $video);
        
        }
      
      } 
    
    }

    $returnData = [
    
      'list' => $sortVideos,

      'page' => $vids['page'],

      'total' => $vids['total']
    
    ];

    return $returnData;

  }

  /**
   * 查询用户喜欢的视频
   *
   * @param int uid
   *
   * @return array list
   */
  public function getUserFavoriteVideos($uid, $order, $page, $pageSize) {
  
    $vids = $this->_vfsv->getUserFavoriteIds($uid, $order, $page, $pageSize);

    $idArr = [];

    foreach($vids['list'] as $vid) {
    
      array_push($idArr, $vid['video_id']);
    
    }

    $videos = $this->_vsv->addVideoCategoryField($this->_vsv->all([ 'id' => implode(',', $idArr) ]));

    $sortVideos = [];
  
    foreach($idArr as $id) {
    
      foreach($videos as $video) {
      
        if ($id == $video['id']) {
        
          array_push($sortVideos, $video);
        
        }
      
      }
    
    }

    $returnData = [
    
      'list' => $sortVideos,

      'page' => $vids['page'],

      'total' => $vids['total']
    
    ];

    return $returnData;
  
  }

}
