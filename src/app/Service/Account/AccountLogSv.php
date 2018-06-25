<?php
namespace App\Service\Account;

use App\Service\Account\AccountSv;
use Core\Service\CurdSv;

/**
 * 账户记录
 */
class AccountLogSv extends BaseService {

  use CurdSv;

  public function create($data) {
  
    $newLog = [
    
      'account_id' => $data['account'],
      'member_id' => $data['member_id'],
      'money' => $data['money'],
      'change_type' => $data['change_type'],
      'relat_id' => $data['relat_id'],
      'relat_type' => $data['relat_type'],
      'created_at' => date('Y-m-d H:i:s')
    
    ];
  
    return $this->add($newLog);
  
  }

  public function getList($data) {
  
    $query = [];

    if ($data['member_id']) {
    
      $query['member_id'] = $data['member_id'];
    
    }
    if ($data['account_id']) {
    
      $query['account_id'] = $data['account_id'];
    
    }
  
    return $this->queryList($query, $data['fields'], $data['order'], $data['page'], $data['page_size']);
  
  }

}
