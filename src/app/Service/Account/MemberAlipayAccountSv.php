<?php
namespace App\Service\Account;

use App\Service\BaseService;
use Core\Service\CurdSv;

/**
 * 合伙人支付宝账号
 *
 * @author 
 */
class MemberAlipayAccountSv extends BaseService {

  use CurdSv;

  /**
   * 新建支付宝账号
   *
   */
  public function create($data) {
  
    $newAccount = [
    
      'member_id' => $data['member_id'],
      'account' => $data['account'],
      'real_name' => $data['real_name'],
      'created_at' => date('Y-m-d H:i:s')
    
    ];
  
    return $this->add($newAccount);
  
  }

  /**
   * 查询支付宝账户详情
   */
  public function getDetail($data) {
  
    if ($data['member_id']) {
    
      return $this->findOne([ 'member_id' => $data['member_id'] ]);
    
    } elseif ($data['id']) {
    
      return $this->findOne($data['id']);
    
    }
  
    return NULL;
  
  }

}
