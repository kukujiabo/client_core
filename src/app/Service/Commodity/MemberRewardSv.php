<?php
namespace App\Service\Commodity;

use \Core\Service\CurdSv;
use App\Service\BaseService;
use App\Service\Crm\MemberSv;
use App\Service\Crm\RewardRuleSv;

/**
 * 会员赠品服务
 *
 * @author Meroc Chen <398515393@qq.com> 2018-06-07
 */
class MemberRewardSv extends BaseService {

  use CurdSv;

  /**
   * 新建赠品实例
   *
   * @param array data
   *
   * @return int id
   */
  public function create($data) {

    $code = '';

    do {
    
      $code = $this->generateRewardCode();
    
      $exist = $this->findOne(['code' => $code]);
    
    } while($exist);
  
    $newReward = [
    
      'member_id' => $data['member_id'],
      'reward_id' => $data['reward_id'],
      'code' => $this->generateRewardCode(),
      'reference' => $data['reference'] ? $data['reference'] : 0,
      'type' => $data['type'],
      'checked' => 0,
      'start_time' => $data['start_time'],
      'end_time' => $data['end_time'],
      'created_at' => date('Y-m-d H:i:s')
    
    ];
  
    return $this->add($newReward);
  
  }

  /**
   * 更新赠品信息
   *
   * @param array 
   *
   * @return 
   */
  public function edit($data) {
  
    $id = $data['id'];

    $updateData = [];

    if ($data['checkd']) {
    
      $updateData['checked'] = 1;

      $updateData['checked_at'] = date('Y-m-d H:i:s');
    
    }
  
  }

  /**
   * 生成券码
   *
   * @return string code
   */
  protected function generateRewardCode() {
  
    $str = 'ABCDEFGHIJKLMNOPQRSTUVWXVZ0123456798';

    $code = '';

    for($i = 0; $i < 8; $i++) {
    
      $code .= $str[rand(0, 35)];
    
    }
      
    return $code;
  
  }

  /**
   * 查询列表
   *
   * @param array $data
   *
   * @return array list
   */
  public function getList($data) {

    $query = [];

    if (isset($data['member_name'])) {
    
      $query['member_name'] = $data['member_name'];
    
    }

    if (isset($data['reward_name'])) {
    
      $query['reward_name'] = $data['reward_name'];
    
    }
  
    if (isset($data['checked'])) {
    
      $query['checked'] = $data['checked'];
    
    }
  
    if (isset($data['reference'])) {
    
      $query['reference'] = $data['reference'];
    
    }

    if (isset($data['type'])) {
    
      $query['type'] = $data['type'];
    
    }

    $order = $data['order'] ? $data['order'] : 'created_at desc';

    $view = new VMemberRewardsSv();

    return $view->queryList($query, $data['fields'], $order, $data['page'], $data['page_size']);

  }

  /**
   * 会员有效计数赠品列表
   *
   * @param array data
   *
   * @return array list
   */
  public function getInsList($data) {
  
    $query = [];

    if (isset($data['member_id'])) {
    
      $query['member_id'] = $data['member_id'];
    
    }
    if (isset($data['reward_id'])) {
    
      $query['member_id'] = $data['reward_id'];
    
    }

    $mcrsSv = new VMemberCntRewardShopSv();

    return $mcrsSv->queryList($query, $data['fields'], 'num desc', $data['page'], $data['page_size']);
  
  }

  /**
   * 查询用户是否自行领取过
   *
   */
  public function checkExist($memberId, $rewardId) {
  
    return $this->findOne([

      'member_id' => $memberId,
      
      'reward_id' => $rewardId,
    
      'origin' => 1
    
    ]);
  
  }

  /**
   * 核销赠品
   *
   * @param array data
   *
   * @return int num
   */
  public function checkout($data) {
  
    $query = [
    
      'reward_id' => $data['reward_id'],

      'member_id' => $data['member_id'],

      'checked' => 0,
    
    ];

    $qList = $this->queryList($query, '*', 'created_at asc', 1, $data['num']);

    $rewards = $qList['list'];

    if (count($rewards) < $data['num']) {
    
      return 0;       
    
    }

    $rsv = new RewardSv();

    $rinst = $rsv->findOne($data['reward_id']);

    if ($rinst['check_code'] != $data['code']) {
    
      return -1;
    
    }

    $updateIds = [];

    foreach($rewards as $reward) {
    
      array_push($updateIds, $reward['id']);
    
    }
    
    return $this->batchUpdate([ 'id' => implode(',', $updateIds) ], [ 'checked' => 1 ]);
  
  }

  /**
   * 新建贷款奖励
   *
   */
  public function createLoanReward($applyId, $memberId, $identity, $relatId) {

    $msv = new MemberSv();

    $member = $msv->findOne($memberId);

    /**
     * 先判断申请人是否散客
     */
    if ($member['member_type'] == 0) {
    
      return; //散客不计件
    
    } else {

      $ruleSv = new LoanRewardRuleSv();

      /**
       * 如果是一级代理
       */
      if ($member['member_type'] == 3) {

        $rule = $ruleSv->findOne([ 'loan_id' => $relatId, 'member_id' => $member['id'] ]);

        if (!$rule) {
        
          $rule = $ruleSv->findOne([ 'loan_id' => $relatId, 'member_id' => 0 ]);

        }

        $newReward = [
        
          'apply_id' => $applyId,
          'member_id' => $member['id'],
          'member_type' => $member['member_type'],
          'relat_id' => $relatId,
          'relat_type' => 1,
          'rule_id' => $rule['id'],
          'money' => $rule['senior_reward'] + $rule['sub_reward'],
          'writeoff' => 0,
          'created_at' => date('Y-m-d H:i:s')
        
        ];

        return $this->add($newReward);
      
      } elseif ($member['member_type']  == 2) {
      
        $supervisor = $msv->findOne([ 'member_identity' => $identity ]);

        $rule = $ruleSv->findOne([ 'card_id' => $relatId, 'member_id' => $supervisor['id'] ]);

        if (!$rule) {
        
          $rule = $ruleSv->findOne([ 'card_id' => $relatId, 'member_id' => 0 ]);

        }
      
        $newReward1 = [
        
          'apply_id' => $applyId,
          'member_id' => $member['id'],
          'member_type' => $member['member_type'],
          'relat_id' => $relatId,
          'relat_type' => 1,
          'rule_id' => $rule['id'],
          'money' => $rule['sub_reward'],
          'writeoff' => 0,
          'created_at' => date('Y-m-d H:i:s')
        
        ];

        $newReward2 = [
        
          'apply_id' => $applyId,
          'member_id' => $supervisor['id'],
          'member_type' => $supervisor['member_type'],
          'relat_id' => $relatId,
          'relat_type' => 1,
          'rule_id' => $rule['id'],
          'money' => $rule['senior_reward'],
          'writeoff' => 0,
          'created_at' => date('Y-m-d H:i:s')
        
        ];

        $newRewards = [];

        array_push($newRewards, $newReward1, $newReward2);

        return $this->batchAdd($newRewards);
      
      } elseif ($member['member_type'] == 1) {
      
        $sub = $msv->findOne([ 'member_identity' => $identity ]);

        $supervisor = $msv->findOne([ 'member_identity' => $sub['reference'] ]);
      
        $rule = $ruleSv->findOne([ 'card_id' => $relatId, 'member_id' => $supervisor['id'] ]);

        if (!$rule) {
        
          $rule = $ruleSv->findOne([ 'card_id' => $relatId, 'member_id' => 0 ]);

        }
      
        $newReward1 = [
        
          'apply_id' => $applyId,
          'member_id' => $sub['id'],
          'member_type' => $sub['member_type'],
          'relat_id' => $relatId,
          'relat_type' => 1,
          'rule_id' => $rule['id'],
          'money' => $rule['sub_reward'],
          'writeoff' => 0,
          'created_at' => date('Y-m-d H:i:s')
        
        ];

        $newReward2 = [
        
          'apply_id' => $applyId,
          'member_id' => $supervisor['id'],
          'member_type' => $supervisor['member_type'],
          'relat_id' => $relatId,
          'relat_type' => 1,
          'rule_id' => $rule['id'],
          'money' => $rule['senior_reward'],
          'writeoff' => 0,
          'created_at' => date('Y-m-d H:i:s')
        
        ];

        $newRewards = [];

        array_push($newRewards, $newReward1, $newReward2);

        return $this->batchAdd($newRewards);
      
      }

    }
  
  }

  /**
   * 新建信用卡奖励
   *
   */
  public function createCardReward($applyId, $memberId, $identity, $relatId) {

    $msv = new MemberSv();

    $member = $msv->findOne($memberId);

    /**
     * 先判断申请人是否散客
     */
    if ($member['member_type'] == 0) {
    
      return; //散客不计件
    
    } else {

      $ruleSv = new RewardRuleSv();

      /**
       * 如果是一级代理
       */
      if ($member['member_type'] == 3) {

        $rule = $ruleSv->findOne([ 'card_id' => $relatId, 'member_id' => $member['id'] ]);

        if (!$rule) {
        
          $rule = $ruleSv->findOne([ 'card_id' => $relatId, 'member_id' => 0 ]);

        }

        $newReward = [
        
          'apply_id' => $applyId,
          'member_id' => $member['id'],
          'member_type' => $member['member_type'],
          'relat_id' => $relatId,
          'relat_type' => 1,
          'rule_id' => $rule['id'],
          'money' => $rule['senior_reward'] + $rule['sub_reward'],
          'writeoff' => 0,
          'created_at' => date('Y-m-d H:i:s')
        
        ];

        return $this->add($newReward);
      
      } elseif ($member['member_type']  == 2) {
      
        $supervisor = $msv->findOne([ 'member_identity' => $identity ]);

        $rule = $ruleSv->findOne([ 'card_id' => $relatId, 'member_id' => $supervisor['id'] ]);

        if (!$rule) {
        
          $rule = $ruleSv->findOne([ 'card_id' => $relatId, 'member_id' => 0 ]);

        }
      
        $newReward1 = [
        
          'apply_id' => $applyId,
          'member_id' => $member['id'],
          'member_type' => $member['member_type'],
          'relat_id' => $relatId,
          'relat_type' => 1,
          'rule_id' => $rule['id'],
          'money' => $rule['sub_reward'],
          'writeoff' => 0,
          'created_at' => date('Y-m-d H:i:s')
        
        ];

        $newReward2 = [
        
          'apply_id' => $applyId,
          'member_id' => $supervisor['id'],
          'member_type' => $supervisor['member_type'],
          'relat_id' => $relatId,
          'relat_type' => 1,
          'rule_id' => $rule['id'],
          'money' => $rule['senior_reward'],
          'writeoff' => 0,
          'created_at' => date('Y-m-d H:i:s')
        
        ];

        $newRewards = [];

        array_push($newRewards, $newReward1, $newReward2);

        return $this->batchAdd($newRewards);
      
      } elseif ($member['member_type'] == 1) {
      
        $sub = $msv->findOne([ 'member_identity' => $identity ]);

        $supervisor = $msv->findOne([ 'member_identity' => $sub['reference'] ]);
      
        $rule = $ruleSv->findOne([ 'card_id' => $relatId, 'member_id' => $supervisor['id'] ]);

        if (!$rule) {
        
          $rule = $ruleSv->findOne([ 'card_id' => $relatId, 'member_id' => 0 ]);

        }
      
        $newReward1 = [
        
          'apply_id' => $applyId,
          'member_id' => $sub['id'],
          'member_type' => $sub['member_type'],
          'relat_id' => $relatId,
          'relat_type' => 1,
          'rule_id' => $rule['id'],
          'money' => $rule['sub_reward'],
          'writeoff' => 0,
          'created_at' => date('Y-m-d H:i:s')
        
        ];

        $newReward2 = [
        
          'apply_id' => $applyId,
          'member_id' => $supervisor['id'],
          'member_type' => $supervisor['member_type'],
          'relat_id' => $relatId,
          'relat_type' => 1,
          'rule_id' => $rule['id'],
          'money' => $rule['senior_reward'],
          'writeoff' => 0,
          'created_at' => date('Y-m-d H:i:s')
        
        ];

        $newRewards = [];

        array_push($newRewards, $newReward1, $newReward2);

        return $this->batchAdd($newRewards);
      
      }

    }
  
  }

}
