<?php
namespace App\Service\Account;

use App\Service\BaseService;
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
    if ($data['change_type']) {
    
      $query['change_type'] = $data['change_type'];
    
    }
    if ($data['relat_type']) {
    
      $query['relat_type'] = $data['relat_type'];
    
    }
    if ($data['relat_id']) {
    
      $query['relat_id'] = $data['relat_id'];
    
    }
  
    return $this->queryList($query, $data['fields'], $data['order'], $data['page'], $data['page_size']);
  
  }

  /**
   * 查询详细信息列表
   *
   */
  public function getUnionLogInfoList() {
  
    if ($data['member_id']) {
    
      $query['member_id'] = $data['member_id'];
    
    }
    if ($data['account_id']) {
    
      $query['account_id'] = $data['account_id'];
    
    }
    if ($data['change_type']) {
    
      $query['change_type'] = $data['change_type'];
    
    }
    if ($data['relat_type']) {
    
      $query['relat_type'] = $data['relat_type'];
    
    }
    if ($data['relat_id']) {
    
      $query['relat_id'] = $data['relat_id'];
    
    }

    $vmaSv = new VMemberAccountLogSv();
  
    return $vmaSv->queryList($query, $data['fields'], $data['order'], $data['page'], $data['page_size']);
  
  }

}
