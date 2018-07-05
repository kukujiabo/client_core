<?php
namespace App\Service\Crm;

use App\Service\BaseService;
use Core\Service\CurdSv;

/**
 * 贷款奖励规则
 *
 * @author Meroc Chen
 */
class LoanRewardRuleSv extends BaseService {

  use CurdSv;

  /**
   * 新建贷款代理奖励规则
   *
   * @param data
   *
   * @return
   */
  public function create($data) {

    $exist = $this->findOne([ 'member_id' => $data['member_id'], 'loan_id' => $data['loan_id'] ]);

    if ($exist) {
    
      $this->throwError($this->_err->DUPLICATECARDRULEMSG, $this->_err->DUPLICATECARDRULECODE);
    
    }

    $newRule = [
    
      'member_id' => $data['member_id'] ? $data['member_id'] : 0,
      'loan_id' => $data['loan_id'],
      'senior_reward' => $data['senior_reward'],
      'sub_reward' => $data['sub_reward'],
      'remark' => $data['remark'],
      'created_at' => date('Y-m-d H:i:s'),
      'state' => 1
    
    ];
  
    return $this->add($newRule);
  
  }

  /**
   * 查询代理奖励规则列表
   *
   * @param array data
   *
   * @return array list
   */
  public function getList($data) {
  
    $infoSv = new VLoanRewardRuleInfoSv();

    $query = [];

    if ($data['member_name']) {
    
      $query['member_name'] = $data['member_name'];

    }

    if ($data['loan_id']) {
    
      $query['loan_id'] = $data['loan_id'];
    
    }

    return $infoSv->queryList($query, $data['fields'], $data['order'], $data['page'], $data['page_size']);
  
  }

  /**
   * 查询规则详情
   *
   * @return array data
   */
  public function getRuleDetail($data) {

    return $this->findOne($data['id']);
  
  }

  /**
   * 更新规则
   *
   */
  public function updateRule($data) {

    $id = $data['id'];

    $updateData = [];
    
    if ($data['senior_reward']) {
    
      $updateData['senior_reward'] = $data['senior_reward']; 
    
    }
    if ($data['sub_reward']) {
    
      $updateData['sub_reward'] = $data['sub_reward']; 
    
    }
    if ($data['state']) {
    
      $updateData['state'] = $data['state']; 
    
    }
    if ($data['remark']) {
    
      $updateData['remark'] = $data['remark']; 
    
    }
  
    return $this->update($id, $updateData);
  
  }

}
