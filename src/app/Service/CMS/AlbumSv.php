<?php
namespace App\Service\CMS;

use App\Model\Member;
use App\Model\Author;
use Core\Service\CurdSv;
use App\Service\BaseService;
use App\Service\Crm\MemberSv;
use App\Service\Admin\AdminSv;
use App\Exception\LogException;

/**
 * 专辑服务
 *
 * @author Meroc Chen <398515393@qq.com> 2018-02-05
 */
class AlbumSv extends BaseService {

  use CurdSv;

  /**
   * 添加专辑
   *
   * @param int $memberId
   * @param int $title
   * @param int $brief
   * @param int $cover
   *
   * @return int $id
   */
  public function addAlbum($authorId, $memberId, $title, $brief, $cover, $introduction, $status) {

    $newAlbum = [
    
      'author_id' => $authorId,

      'member_id' => $memberId,

      'title' => $title,

      'brief' => $brief,

      'cover' => $cover,

      'introduction' => $introduction,

      'status' => $status,

      'created_at' => date('Y-m-d H:i:s')
    
    ];

    return $this->add($newAlbum);
  
  }

  /**
   * 编辑专辑信息
   *
   * @param int title
   * @param int brief
   * @param int cover
   * @param int status
   *
   * @return array $data
   */
  public function editAlbum($id, $data) {

    $album = $this->findOne($id);

    if (!$album) {
    
      throw new LogException($this->_err->ABNOTFOUNDMSG, $this->_err->ABNOTFOUNDCODE);
    
    }
  
    return $this->update($id, $data);
  
  }

  /**
   * 查询列表
   *
   * @param array query
   * @param int query.memberId
   * @param int query.keyword
   * @param int query.state
   * @param int all
   * @param int page
   * @param int pageSize
   * @param string fields
   *
   * @return array $data
   */
  public function listQuery($title, $authorName, $albumType, $status = NULL, $order = 'id desc', $all = 0, $page = 1, $pageSize = 20, $fields = '*') {

    $query = [];
  
    $albums = [];

    $members = [];

    $admins = [];

    $memberSv = new MemberSv();

    $adminSv = new AdminSv();

    isset($title) ? $query['title'] = $title : NULL;

    isset($status) ? $query['status'] = $status : NULL;

    $albumType == 1 ? $query['author_id'] = 0 : ( $albumType == 2 ? $query['author_id'] = 'g|0' : NULL );

    if (isset($authorName)) {
    
      if ($albumType == 1) {
      
        $aids = [];

        $admins = $adminSv->all([ 'admin_name' => $authorName ]);

        foreach($admins as $admin) {
        
          array_push($aids, $admin['id']);
        
        }

        $query['member_id'] = implode(',', $aids);

      } elseif ($albumType == 2) {

        $aids = [];

        $members = $memberSv->all([ 'member_name' => $authorName ]);

        foreach($members as $member) {
        
          array_push($aids, $member['id']);
        
        }

        $query['member_id'] = implode(',', $aids);
      
      } else {
      
        $aids = [];

        $members = $memberSv->all([ 'member_name' => $authorName ]);

        $admins = $adminSv->all([ 'admin_name' => $authorName ]);

        foreach($members as $member) {
        
          array_push($aids, $member['id']);
        
        }
        foreach($admins as $admin) {
        
          array_push($aids, $admin['id']);
        
        }

        $aids = array_unique($aids);

        if (empty($aids)) {
        
          return [

            'list' => [],

            'page' => $page,

            'total' => 0
          
          
          ];
        
        }

        $query['member_id'] = implode(',', $aids);
      
      
      }
    
    }

    if ($all) {

      $albums = $this->all($query, $order);

      $tmpAlbums = $albums;
    
    } else {
    
      $albums = $this->queryList($query, $fields, $order, $page, $pageSize);

      $tmpAlbums = $albums['list'];
    
    }

    foreach ($tmpAlbums as $album) {

      if ($album['author_id']) {

        if (!in_array($album['member_id'], $members)) {
      
          array_push($members, $album['member_id']);

        }
      
      } else {

        if (!in_array($album['member_id'], $admins)) {

          array_push($admins, $album['member_id']);

        }

      }
    
    }

    if (!empty($members)) {
    
      $memberCondition = [
        
        'id' => implode(',', $members)

      ];


      $memberInfo = $memberSv->all($memberCondition);

      foreach($tmpAlbums as $key => $album) {

        foreach($memberInfo as $info) {
      
          if ($album['member_id'] && $album['member_id'] == $info['id']) {
        
            $tmpAlbums[$key]['author'] = $info['member_name'];
          
          }

        }
      
      }
    
    }

    if (!empty($admins)) {
    
      $adminCondition = [
      
        'id' => implode(',', $admins)

      ];
    
      $adminInfo = $adminSv->all($adminCondition);
      
      foreach($tmpAlbums as $key => $album) {
      
        foreach($adminInfo as $info) {

          if (!$album['author_id'] && $album['member_id'] == $info['id']) {

            $tmpAlbums[$key]['author'] = $info['admin_name'];

          }
        
        } 
      
      }
    
    }

    if ($all) {
    
      return $tmpAlbums;
    
    } else {
    
      $albums['list'] = $tmpAlbums;

      return $albums;
    
    }
  
  }


}
