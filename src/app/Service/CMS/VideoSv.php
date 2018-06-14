<?php namespace App\Service\CMS;

use App\Service\BaseService;
use Core\Service\CurdSv;

use App\Service\Crm\MemberSv;
use App\Service\Admin\AdminSv;
use App\Service\CMS\AlbumSv;
use App\Service\CMS\VideoCategorySv;

use App\Exception\LogException;
use App\Library\Http;

/**
 * 视频服务
 *
 * @author Meroc Chen <398515393@qq.com> 2018-02-05
 */
class VideoSv extends BaseService {

  use CurdSv;

  /**
   * 添加视频
   * 
   * @param string outId
   * @param int memberId
   * @param int categoryId
   * @param int albumId
   * @param string title
   * @param string brief
   * @param string url
   *
   * @return boolean true/false
   */
  public function addVideo($outId, $authorId, $memberId, $categoryId, $cover, $albumId, $title, $brief, $introduction, $url, $status, $duration, $sort) {

    $newVideo = [
    
      'out_id' => $outId,

      'author_id' => $authorId,

      'member_id' => $memberId,

      'category_id' => $categoryId,

      'cover' => $cover,

      'album_id' => $albumId,

      'title' => $title,

      'brief' => $brief,

      'introduction' => $introduction,

      'url' => $url,

      'status' => $status,

      'duration' => $duration,

      'sort' => $sort,

      'created_at' => date('Y-m-d H:i:s'),

      'times' => time()
    
    ];

    return $this->add($newVideo);
  
  }

  /**
   * 编辑视频信息
   * 
   * @param array videoInfo
   * @param int videoInfo.id
   * @param int videoInfo.out_id
   * @param int videoInfo.category_id
   * @param int videoInfo.album_id
   * @param string videoInfo.title
   * @param string videoInfo.brief
   * @param string videoInfo.cover
   * @param int videoInfo.status
   *
   * @return boolean true/false
   */
  public function editVideo($id, $data) {

    $video = $this->findOne($id);
    
    if (!$video) {
    
      throw new LogException($this->_err->VDMISSMSG, $this->_err->VDMISSCODE);
    
    } 

    if (empty($data)) {
    
      throw new LogException($this->_err->VDEMPTYMSG, $this->_err->VDEMPTYCODE);
    
    }

    return $this->update($id, $data);
  
  }

  /**
   * 查询视频列表
   * 
   * @param string outId
   * @param int memberId
   * @param int categoryId
   * @param int albumId
   * @param string keyword
   *
   * @return boolean true/false
   */
  public function listQuery($outId, $memberId, $categoryId, $albumId, $keyword, $status, $sort, $times, $order, $all = 0, $page = 1, $pageSize = 20, $fields = '*') {
  
    $options = [];

    if (isset($outId)) $options['out_id'] = $outId;

    if (isset($memberId)) $options['member_id'] = $memberId;

    if (isset($categoryId)) $options['category_id'] = $categoryId;

    if (isset($albumId)) $options['album_id'] = $albumId;

    if (isset($keyword)) $options['title'] = $keyword;

    if (isset($status)) $options['status'] = $status;

    if (isset($sort)) $options['sort'] = $sort;

    if (isset($times)) $options['times'] = $times;

    $videos = [];

    if ($all) {
    
      $videos = $this->all($options, $order);
    
    } else {
  
      $videos = $this->queryList($options, $fields, $order, $page, $pageSize);

    }

    $albums = [];
    $categories = [];
    $members = [];
    $admins = [];

    $tmpVideos = $all ? $videos : $videos['list'];

    foreach($tmpVideos as $video) {

      if (!in_array($video['album_id'], $albums)) {
      
        $video['album_id'] ? array_push($albums, $video['album_id']) : null;
      
      }
    

      if (!in_array($video['category_id'], $categories)) {
    
        array_push($categories, $video['category_id']);

      }

      if ($video['author_id']) {
      
        array_push($members, $video['member_id']);
      
      } else {
      
        array_push($admins, $video['member_id']);
      
      }
    
    }

    if (!empty($albums)) {

      $albumSv = new AlbumSv();

      $albumCondition = [ 'id' => implode(',', $albums) ];
    
      $albumData = $albumSv->all($albumCondition);
    
    }

    if (!empty($categories)) {
    
      $categorySv = new VideoCategorySv();

      $categoryCondition = [ 'id' => implode(',', $categories) ];

      $categoryData = $categorySv->all($categoryCondition);
    
    }

    if (!empty($members)) {
    
      $memberSv = new MemberSv();

      $memberCondition = [ 'id' => implode(',', $members) ];

      $memberData = $memberSv->all($memberCondition);
    
    }

    if (!empty($categories)) {
    
      $adminSv = new AdminSv();

      $adminCondition = [ 'id' => implode(',', $admins) ];

      $adminData = $adminSv->all($adminCondition);
    
    }

    foreach($tmpVideos as $key => $video) {
    
      foreach($albumData as $album) {
      
        if ($video['album_id'] == $album['id']) {
        
          $tmpVideos[$key]['album_name'] = $album['title'];
        
        }
      
      }
      foreach($categoryData as $category) {
      
        if ($video['category_id'] == $category['id']) {
        
          $tmpVideos[$key]['category_name'] = $category['name'];
        
        }
      
      }

      if ($video['author_id']) {
      
        foreach($memberData as $member) {
        
          if ($video['member_id'] == $member['id']) {
          
            $tmpVideos[$key]['author'] = $member['member_name'];
          
          }
        
        }
      
      } else {
      
        foreach($adminData as $admin) {

          if ($video['member_id'] == $admin['id']) {
          
            $tmpVideos[$key]['author'] = $admin['admin_name'];
          
          }
        
        }
      
      }
    
    }

    if ($all) {
    
      return $tmpVideos;
    
    } else {
    
      $videos['list'] = $tmpVideos;

      return $videos;
    
    }
  
  }

  /**
   * 获取视频详情，附带用户收藏，点赞等信息
   *
   * @param int uid
   * @param int id
   *
   * @return
   */
  public function detail($uid, $id) {

    $video = $this->findOne($id);

    if (!$video) {
    
      return null;
    
    }

    /**
     * 获取专辑名称
     */
    $vcsv = new VideoCategorySv();

    $category = $vcsv->findOne($video['category_id']);

    $video['category_name'] = $category['name'];

    /**
     * 当uid存在时，判断是否被收藏
     */
    if ($uid) {

      $vct = new VideoCollectionSv();

      $collection = $vct->findOne([
      
        'member_id' => $uid,

        'video_id' => $id,
      
        'active' => 1
      
      ]);

      $vft = new VideoFavoriteSv();

      $favorite = $vft->findOne([
      
        'member_id' => $uid,

        'video_id' => $id,

        'active' => 1
      
      ]);

      $collection ? $video['collect'] = true : $video['collect'] = false;

      $favorite ? $video['favorite'] = true : $video['favorite'] = false;

    }
  
    return $video;
  
  }

  /**
   * 视频数据添加分类名称字段
   *
   * @param array videos
   *
   * @return list
   */
  public function addVideoCategoryField($videos) {

    $categories = [];  

    foreach($videos as $video) {
    
      array_push($categories, $video['category_id']);
    
    }
  
    $categorySv = new VideoCategorySv();

    $categoryCondition = [ 'id' => implode(',', $categories) ];

    $categoryData = $categorySv->all($categoryCondition);

    foreach($videos as $key => $video) {
    
      foreach($categoryData as $ca) {
      
        if ($ca['id'] = $video['category_id']) {
        
          $videos[$key]['category_name'] = $ca['name'];
        
        }
      
      }
    
    }

    return $videos;
  
  }

}
