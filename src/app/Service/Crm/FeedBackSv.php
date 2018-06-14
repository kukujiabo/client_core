<?php
namespace App\Service\Crm;

use App\Service\BaseService;
use Core\Service\CurdSv;

/**
 * 意见反馈服务
 *
 * @author Meroc Chen <398515393@qq.com> 2018-02-02
 */
class FeedBackSv extends BaseService {

  use CurdSv;

  /** 
   * 新增意见反馈
   *
   * @param int $memberId
   * @param int $content
   *
   * @return int $id
   */
  public function addFeedback($memberId, $content) {
  
    $newFeedback = [
    
      'member_id' => $memberId,

      'content' => $content,

      'created_at' => date('Y-m-d H:i:s')

    ];

    return $this->add($newFeedback);
  
  }

}
