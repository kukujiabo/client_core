<?php
namespace App\Service\Comment;

use Core\Service\CurdSv;
use App\Service\BaseService;

/**
 * 会员评论视图
 *
 * @author Meroc Chen <398515393@qq.com> 2018-02-24
 */
class MemberCommentSv extends BaseService {

  use CurdSv;

  /**
   * 用户评论列表
   *
   * @param int objectId
   * @param string memberId
   * @param string rootId
   * @param string replyTo
   * @param string order
   * @param int page
   * @param int pageSize
   * @param string fields
   *
   * @return array list
   */
  public function listQuery($objectId, $module, $memberId = null, $rootId = null, $replyTo = null, $status = 1, $order = '', $all = 0, $page = 1, $pageSize = 20, $fields = '*') {
  
    $options = [

      'object_id' => $objectId,

      'module' => $module
    
    ];

    if (isset($memberId)) $options['member_id'] = $memberId;

    if (isset($rootId)) $options['root_id'] = $rootId;

    if (isset($replyTo)) $options['reply_to'] = $replyTo;

    if ($all) {
    
      return $this->all($options);
    
    } else {
    
      return $this->queryList($options, $fields, $order, $page, $pageSize);
    
    }
  
  }

  /**
   * 根据评论对象id获取评论列表
   *
   * @param int objectId
   * @param int module
   * @param int page
   * @param int pageSize
   *
   * @return array list
   */
  public function getCommentsByObjectId($objectId, $module, $page, $pageSize) {
  
    $list = $this->listQuery($objectId, $module, null, 0, null, 1, 'created_at asc', 0, $page, $pageSize);

    $comments = $list['list'];

    if (!empty($comments)) {
    
      $rootIds = [];

      foreach($comments as $comment) {
      
        array_push($rootIds, $comment['id']);
      
      }

      $subComments = $this->listQuery($objectId, $module, null, implode(',', $rootIds), null, 1, 'created_at asc', 1);

      if (!empty($subComments)) {
      
        $list['sub_list'] = $subComments;
      
      }
    
    }

    return $list;
  
  }

}
