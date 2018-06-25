<?php
namespace App\Service\Merchant;

use App\Service\BaseService;
use App\Service\Crm\MemberSv;
use App\Service\Commodity\MemberRewardSv;
use App\Service\Crm\VBapplyMemberCardSv;
use App\Service\Crm\VBapplyMemberLoanSv;
use App\Service\Account\AccountSv;
use Core\Service\CurdSv;

/**
 * 信用卡申请
 *
 */
class BusinessApplySv extends BaseService {

  use CurdSv;

  /**
   * 新增申请
   *
   * @param array data
   *
   * @return int id
   */
  public function create($data) {

    $msv = new MemberSv();

    $member = $msv->findOne($data['member_id']);

    $bankId = 0;

    if ($type == 'card') {

      $shop = new ShopSv();
    
      $card = $shop->findOne($data['relat_id']);

      $bankId = $card['mid'];
    
    }
  
    $newData = [
    
      'member_id' => $data['member_id'],
      'type' => $data['type'],
      'relat_id' => $data['relat_id'],
      'name' => $data['name'],
      'address' => $data['address'],
      'contact' => $data['contact'],
      'phone' => $data['phone'],
      'wechat' => $data['wechat'],
      'bank_id' => $bankId,
      'brief' => $data['brief'],
      'reference' => $member['reference'],
      'created_at' => date('Y-m-d H:i:s')
    
    ];

    $mrsv = new MemberRewardSv();

    $applyId = $this->add($newData); 

    if ($data['type'] == 'card') {

      $mrsv->createCardReward($applyId, $data['member_id'], $member['reference'], $data['relat_id']);

    } else {
    
      $mrsv->createLoanReward($applyId, $data['member_id'], $member['reference'], $data['relat_id']);
    
    }

    return $applyId;
  
  }

  /**
   * 查询申请列表
   *
   * @param array data
   *
   * @return array list
   */
  public function listQuery($data) {

    $query = [];
  
    if (isset($data['name'])) {
    
      $query['name'] = $data['name'];
    
    }
    if (isset($data['contact'])) {
    
      $query['contact'] = $data['contact'];
    
    }
    if (isset($data['phone'])) {
    
      $query['phone'] = $data['phone'];
    
    }

    $vbaSv = new VBapplyMemberCardSv();

    return $vbaSv->queryList($query, $data['fields'], $data['order'], $data['page'], $data['page_size']);
  
  }

  /**
   * 查询信用卡申请
   *
   */
  public function getReferenceCards($data) {

    $cardSv = new VBapplyMemberCardSv();

    $query = [ 'reference' => $data['reference'] ];
  
    return $cardSv->queryList($query, '*', 'id desc', $data['page'], $data['page_size']);
  
  }

  /**
   * 查询贷款申请
   *
   */
  public function getReferenceLoans($data) {
  
    $loanSv = new VBapplyMemberLoanSv();
  
    $query = [ 'reference' => $data['reference'] ];

    return $loanSv->queryList($query, '*', 'id desc', $data['page'], $data['page_size']);

  }

  /**
   * 结算佣金
   *
   */
  public function balanceCreditMoney($data) {
  
    $query = [
    
      'state' => 1,

      'write_off' => 0,

      'type' => 'card'

    ];

    if ($data['id']) {
    
      $query['id'] = $data['id'];
    
    }
  
    $checkedApplies = $this->all($query);

    $applyIds = [];

    foreach($checkedApplies as $apply) {
    
      array_push($applyIds, $apply['id']);
    
    }

    $mrSv = new MemberRewardSv();

    $rewards = $mrSv->all([ 'apply_id' => implode(',', $applyIds), 'writeoff' => 0 ]);

    $acctSv = new AccountSv();

    foreach($rewards as $reward) {

      /**
       * 新增账户记录
       */
      $newMoney = [
      
        'member_id' => $reward['member_id'],
        'relat_id' => $reward['relat_id'],
        'relat_type' => $reward['relat_type'],
        'money' => $reward['money'],
      
      ];

      $acctSv->addMoney($newMoney);

      /**
       * 核销奖励金
       */
      $updateReward = [
      
        'writeoff' => 1,
        'writeoff_at' => date('Y-m-d H:i:s')
      
      ];

      $mrSv->update($reward['id'], $updateReward);

      /**
       * 核销申请
       */
      $updateApply = [
      
        'write_off' => 1,
        'write_off_at' => date('Y-m-d H:i:s')
      
      ]

      $acctSv->update($reward['apply_id'], $updateApply);
    
    }

    return count($rewards);
  
  }

}
