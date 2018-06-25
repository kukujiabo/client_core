<?php
namespace App\Service\Merchant;

use App\Service\BaseService;
use App\Service\Crm\MemberSv;
use App\Service\Commodity\MemberRewardSv;
use App\Service\Crm\VBapplyMemberCardSv;
use App\Service\Crm\VBapplyMemberLoanSv;
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

      'write_off' => 1,

      'reference' => 'gt|1'
    
    ];

    if ($data['id']) {
    
      $query['id'] = $data['id'];
    
    }
  
    $checkedApplies = $this->all($query);

    $accountUpdate = [ ];

    foreach($checkedApplies as $apply) {
    
    
    
    }
  
  }

}
