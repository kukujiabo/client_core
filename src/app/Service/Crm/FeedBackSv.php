<?php
namespace App\Service\Crm;

use App\Service\BaseService;
use Core\Service\CurdSv;
use App\Service\Crm\MemberSv;

/**
 * 意见反馈服务
 *
 * @author Meroc Chen <398515393@qq.com> 2018-02-02
 */
class FeedbackSv extends BaseService {

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

    $mSv = new MemberSv();

    $member = $mSv->findOne([ 'id' => $memberId ]);
  
    $newFeedback = [
    
      'member_id' => $memberId,

      'member_name' => $member['member_name'],

      'mobile' => $member['mobile'],

      'content' => $content,

      'created_at' => date('Y-m-d H:i:s')

    ];

    return $this->add($newFeedback);
  
  }

  /**
   * 查询反馈列表
   */
  public function getList($data) {
  
    $query = [];

    if ($data['member_id']) {
    
      $query['member_id'] = $data['member_id'];
    
    }
    if ($data['mobile']) {
    
      $query['mobile'] = $data['mobile'];
    
    }

    return $this->queryList($query, $data['fields'], $data['order'], $data['page'], $data['page_size']);
  
  }

}
