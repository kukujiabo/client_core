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
  
    $newApply = [
    
      'member_id' => $data['member_id'],
      'cash' => $data['cash'],
      'state' => 0,
      'created_at' => date('Y-m-d H:i:s')
    
    ];

    $applyId = $this->add($newApply);

    $acctData = [
    
      'money' => $data['cash'],
      'relat_id' => $applyId,
      'relat_type' => 3,
      'remark' => '代理提现',
      'state' => 0
    
    ];

    $acctSv->minuMoney($acctData);
    
    return $this->applyId;
  
  }

  /**
   * 查询列表
   */
  public function getList($data) {
  
      
  
  }

}
