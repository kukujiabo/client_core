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


}
