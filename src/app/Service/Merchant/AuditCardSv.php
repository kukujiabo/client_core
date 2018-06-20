<?php
namespace App\Service\Merchant;

use App\Service\BaseService;
use Core\Service\CurdSv;

/**
 * 信用卡审核数据
 *
 * @author Meroc Chen
 */
class AuditCardSv extends BaseService {

  use CurdSv;

  /**
   * 查询脱敏数据
   */
  public function getList($data) {
  
    $vacSv = new VAuditBankCardSv();

    $query = [];

    if ($data['sequence']) {
    
      $query['sequence'] = $data['sequence'];
    
    }
    if ($data['bank_id']) {
    
      $query['bank_id'] = $data['bank_id'];
    
    }

    return $vacSv->queryList($query, $data['fields'], $data['order'], $data['page'], $data['page_size']);
  
  }

}
