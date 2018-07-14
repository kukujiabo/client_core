<?php
namespace App\Service\Account;

use Core\Service\CurdSv;
use App\Service\BaseService;
use App\Service\Account\AccountSv;

/**
 * 申请提现
 * @desc 申请提现
 *
 * @author Meroc Chen
 */
class CashApplySv extends BaseService {

  use CurdSv;

  /** 
   * 新建申请
   */
  public function create($data) {

    $acctSv = new AccountSv();
  
    $newApply = [
    
      'member_id' => $data['member_id'],
      'cash' => $data['cash'],
      'state' => 0,
      'created_at' => date('Y-m-d H:i:s')
    
    ];

    $applyId = $this->add($newApply);

    $acctData = [
    
      'member_id' => $data['member_id'],
      'money' => $data['cash'],
      'relat_id' => $applyId,
      'relat_type' => 3,
      'remark' => '代理提现',
      'state' => 0
    
    ];

    $acctSv->minuMoney($acctData);
    
    return $applyId;
  
  }

  /**
   * 查询列表
   */
  public function getList($data) {
  
    $query = [];

    if ($data['member_name']) {

      $query['member_name'] = $data['member_name'];
    
    }
    if ($data['alipay_account']) {

      $query['alipay_account'] = $data['member_name'];
    
    }
    if ($data['member_name']) {

      $query['member_name'] = $data['member_name'];
    
    }
      
    $vmcSv = new VMemberCashApplySv();

    return $vmcSv->queryList($query, $data['fields'], $data['order'], $data['page'], $data['page_size']);
  
  }

}
