<?php
namespace App\Service\Comment;

use App\Service\BaseService;
use Core\Service\CurdSv;

/**
 * 用户评论服务
 *
 * @author Meroc Chen <398515393@qq.com> 2018-02-24
 */
class CommentSv extends BaseService {

  use CurdSv;

  /**
   * 添加评论
   *
   * @param int memberId
   * @param int module
   * @param int objectId
   * @param int rootId
   * @param int replyTo
   * @param string content
   *
   * @return int id
   */
  public function addComment($memberId, $module, $objectId, $rootId, $replyTo, $content) {
  
    $newComment = [
    
      'member_id' => $memberId,

      'module' => $module,

      'object_id' => $objectId,

      'root_id' => $rootId,

      'reply_to' => $replyTo,

      'content' => $content,

      'created_at' => date('Y-m-d H:i:s')

    ];

    return $this->add($newComment);
  
  }

}
