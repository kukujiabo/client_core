<?php
namespace App\Service\Crm;

use App\Service\BaseService;
use Core\Service\CurdSv;

/**
 * 代理奖励规则服务
 *
 * @author Meroc Chen <398515393@qq.com>
 */
class RewardRuleSv extends BaseService {

  use CurdSv;

  /**
   * 新建代理奖励规则
   *
   * @param data
   *
   * @return
   */
  public function create($data) {

    $exist = $this->findOne([ 'member_id' => $data['member_id'], 'card_id' => $data['card_id'] ]);

    if ($exist) {
    
      $this->throwError($this->_err->DUPLICATECARDRULEMSG, $this->_err->DUPLICATECARDRULECODE);
    
    }

    $newRule = [
    
      'member_id' => $data['member_id'] ? $data['member_id'] : 0,
      'card_id' => $data['card_id'],
      'senior_reward' => $data['senior_reward'],
      'sub_reward' => $data['sub_reward'],
      'remark' => $data['remark'],
      'created_at' => date('Y-m-d H:i:s')
    
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
  
    $infoSv = new VRewardRuleInfoSv();

    $query = [];

    if ($data['member_name']) {
    
      $query['member_name'] = $data['member_name'];

    }

    if ($data['card_id']) {
    
      $query['card_id'] = $data['card_id'];
    
    }

    return $infoSv->queryList($query, $data['fields'], $data['order'], $data['page'], $data['page_size']);
  
  }


}
