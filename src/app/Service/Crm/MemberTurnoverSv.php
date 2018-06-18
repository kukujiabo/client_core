<?php
namespace App\Service\Crm;

use App\Service\BaseService;
use Core\Service\CurdSv;

/**
 * 会员流水
 *
 * @author Meroc Chen <398515393@qq.com>
 */
class MemberTurnoverSv extends BaseService {

  use CurdSv;

  /**
   * 查询会员流水列表
   *
   * @retunr array list
   */
  public function getList($data) {
  
    $query = [];

    if ($data['member_id']) {
    
      $query['member_id'] = $data['member_id'];
    
    }

    return $this->queryList($query, $data['fields'], $data['order'], $data['page'], $data['page_size']);
  
  }

}
