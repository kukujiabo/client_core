<?php
namespace App\Service\Account;

use App\Service\BaseService;
use Core\Service\CurdSv;
use App\Model\Account;

/**
 * 用户账户
 *
 */
class AccountSv extends BaseService {

  use CurdSv;

  /**
   * 新建账户
   */
  public function create($data) {
  
    $exist = $this->findOne($data['member_id']);

    if ($exist) {
    
      $this->throwError($this->_err->DUPLICATEACCOUNTMSG, $this->_err->DUPLICATEACCOUNTCODE);
    
    }

    $newAccount = [
    
      'member_id' => $data['member_id'],

      'rest' => 0,

      'history' => 0,

      'created_at' => date('Y-m-d H:i:s')
    
    ];

    return $this->add($newAccount);
  
  }

  /**
   * 查询账户详情
   */
  public function getDetail($data) {
  
    if ($data['id']) {
    
      return $this->findOne($data['id']);
    
    } elseif ($data['member_id']) {
    
      return $this->findOne([ 'member_id' => $data['member_id'] ]);
    
    }

    return NULL;
  
  }

  /**
   * 新增账户余额
   */
  public function addMoney($data) {
  
    $accountInfo = $this->findOne([ 'member_id' => $data['member_id'] ]);

    $newIncome = [
      'rest' => $accountInfo['rest'] + $data['money'],
      'history' => $accountInfo['history'] + $data['money']
    ];

    $newLog = [
      'money' => $data['money'],
      'change_type' => 1,
      'relat_id' => $data['relat_id'],
      'relat_type' => $data['relat_type'],
      'state' => $data['state'],
      'account_id' => $accountInfo['id'],
      'member_id' => $accountInfo['member_id'],
      'created_at' => date('Y-m-d H:i:s')
    ];

    $logSv = new AccountLogSv();

    $logSv->add($newLog);

    return $this->update($accountInfo['id'], $newIncome);
  
  }

  /**
   * 减少余额
   */
  public function minuMoney($data) {
  
    $accountInfo = $this->findOne([ 'member_id' => $data['member_id'] ]);
  
    if ($accountInfo['rest'] < $data['money']) {
    
      $this->throwError($this->_err->NORESTMSG, $this->_err->NORESTCODE); 
    
    }

    $newMinus = [
    
      'rest' => $accountInfo['rest'] - $data['money']
    
    ];

    $newLog = [
      'money' => $data['money'],
      'change_type' => 0,
      'relat_id' => $data['relat_id'],
      'relat_type' => $data['relat_type'],
      'remark' => $data['remark'],
      'state' => $data['state'],
      'account_id' => $accountInfo['id'],
      'member_id' => $accountInfo['member_id'],
      'created_at' => date('Y-m-d H:i:s')
    ];
  
    $logSv = new AccountLogSv();

    $logSv->add($newLog);

    return $this->update($accountInfo['id'], $newMinus);
  
  }

  /**
   * 获取账户列表
   *
   */
  public function getList($data) {
  
    $acmSv = new VMemberAccountInfoSv(); 

    $query = [];

    if ($data['member_name']) {
    
      $query['member_name'] = $data['member_name'];
    
    }
    if ($data['member_type']) {
    
      $query['member_type'] = $data['member_type'];
    
    }

    return $acmSv->queryList($query, $data['fields'], $data['order'], $data['page'], $data['page_size']);
  
  }

}
