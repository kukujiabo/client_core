<?php
namespace App\Service\Merchant;

use App\Service\BaseService;
use App\Service\Crm\MemberSv;
use App\Service\Commodity\MemberRewardSv;
use App\Service\Crm\VBapplyMemberCardSv;
use App\Service\Crm\VBapplyMemberLoanSv;
use App\Service\Crm\LoanThirdLogSv;
use App\Service\Account\AccountSv;
use App\Service\Commodity\RewardSv;
use App\Service\Commodity\AuditLoanSv;
use Core\Service\CurdSv;
use App\Library\Http;

/**
 * 信用卡申请
 *
 */
class BusinessApplySv extends BaseService {

  CONST FATHERID = '6298';

  CONST TDATALINK = "http://www.qichangkeji.vip/qckjgzhManager/DownUser/Add.do";

  use CurdSv;
/**
   * 新增申请
   *
   * @param array data
   *
   * @return int id
   */
  public function create($data) {

    $reference = '';

    if ($data['member_id'] == -1) {
    
      $reference = $data['reference'];
    
    } else {

      $msv = new MemberSv();

      $member = $msv->findOne($data['member_id']);

      $reference = $member['reference'];

    }

    $bankId = 0;

    if ($data['type'] == 'card') {

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
      'reference' => $reference,
      'created_at' => date('Y-m-d H:i:s')
    
    ];

    $mrsv = new MemberRewardSv();

    $applyId = $this->add($newData); 

    if ($data['type'] == 'card') {

      $csv = new ShopSv();

      $card =  $csv->findOne($data['relat_id']);

      if ($card['commission'] > 0) {

        $mrsv->createCardReward($applyId, $data['member_id'], $reference, $data['relat_id']);

      }

    } else {

      $lSv = new RewardSv();

      $loan = $lSv->findOne($data['relat_id']);

      if ($loan['commission'] > 0) {

        if ($loan['is_self'] == 0) {
        
          /**
           * 非自营项目要同步数据给第三方
           */
          $httpParams = [
          
            'name' => $data['contact'],
            'phone' => $data['phone'],
            'fatherId' => BusinessApplySv::FATHERID,
            'goodsId' => $loan['third_id'],
            'type' => 1,
            'otherUserId' => $data['member_id'],
            'idCard' => $data['address']
          
          ];

          $header = [ 'Content-Type:application/x-www-form-urlencoded'];

          $log = new LoanThirdLogSv();

          $newLogData = [
          
            'member_id' => $data['member_id'],

            'send_data' => json_encode($httpParams),

            'reward_id' => $data['relat_id'],

            'goods_id' => $loan['third_id'],

            'created_at' => date('Y-m-d H:i:s')
          
          ];

          $logId = $log->add($newLogData);

          $result = json_decode(Http::httpPost(BusinessApplySv::TDATALINK, $httpParams, $header, '', 5000, 'raw'), true);

          $log->update($logId, ['return_data' => json_encode($result)]);

          if ($result['status'] == 0) {
            /**
             * 贷款同步失败抛出异常
             */
          
            $this->update($applyId,  [ 'synchronization' => 0 ]);

            $this->throwError($this->_err->LOANSYNCFAILEDMSG, $this->_err->LOANSYNCFAILEDCODE);
          
          }
        
        }

        $mrsv->createLoanReward($applyId, $data['member_id'], $reference, $data['relat_id']);

      }
    
    }

    return $applyId;
  
  }

  /**
   * 查询贷款申请列表
   *
   * @param array data
   *
   * @return array list
   */
  public function listLoanQuery($data) {

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
    if (isset($data['loan_name'])) {
    
      $query['loan_name'] = $data['loan_name'];
    
    }

    $vbaSv = new VBapplyMemberLoanSv();

    return $vbaSv->queryList($query, $data['fields'], $data['order'], $data['page'], $data['page_size']);
  
  }


  /**
   * 查询信用卡申请列表
   *
   * @param array data
   *
   * @return array list
   */
  public function listCardQuery($data) {

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
   * 查询信用卡申请(包括自己的，下级的)
   *
   */
  public function getReferenceCards($data) {

    $cardSv = new VBapplyMemberCardSv();

    $mSv = new MemberSv();

    $member = $mSv->findOne($data['member_id']);

    $references = [];

    if ($member['member_type'] == 3) {

      /**
       * 若用户为一级代理，则取出二级代理推荐码
       */
    
      $subs = $mSv->all([ 'reference' => $member['member_identity']  ]);

      foreach($subs as $sub) {

        if ($sub['member_identity']) {
      
          array_push($references, $sub['member_identity']);

        }
      
      }
    
    }

    array_push($references, $member['member_identity']);

    $rstr = implode(',', $references);

    $or = "(member_id = {$member['id']} OR reference in ({$rstr}))";
  
    return $cardSv->queryList([], '*', 'id desc', $data['page'], $data['page_size'], $or);
  
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
   * 结算信用卡佣金
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

    $auditSv = new AuditCardSv();

    foreach($rewards as $reward) {

      $auditData = $auditSv->findOne([ 'apply_id' => $reward['apply_id'] ]);

      /**
       * 新增账户记录
       */
      $newMoney = [
      
        'member_id' => $reward['member_id'],
        'relat_id' => $reward['relat_id'],
        'relat_type' => $reward['relat_type'],
        'money' => $reward['money'],
        'state' => 1
      
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
        'write_off_at' => date('Y-m-d H:i:s'),
        'audit_id' => $auditData['id']
      
      ];

      $acctSv->update($reward['apply_id'], $updateApply);
    
    }

    return count($rewards);
  
  }

  /**
   * 结算贷款佣金
   *
   */
  public function balanceLoanMoney($data) {
  
    $query = [
    
      'state' => 1,

      'write_off' => 0,

      'type' => 'loan'

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

    $auditSv = new AuditLoanSv();

    foreach($rewards as $reward) {

      $auditData = $auditSv->findOne([ 'apply_id' => $reward['apply_id'] ]);

      $money = $reward['money'];

      if ($reward['reward_type'] == 1) {

        $money = $auditData['money'] * ($money/100);
      
      }

      /**
       * 新增账户记录
       */
      $newMoney = [
      
        'member_id' => $reward['member_id'],
        'relat_id' => $reward['relat_id'],
        'relat_type' => $reward['relat_type'],
        'reward_id' => $reward['id'],
        'money' => $money,
        'state' => 1
      
      ];

      $acctSv->addMoney($newMoney);

      /**
       * 核销奖励金
       */
      $updateReward = [
      
        'writeoff' => 1,
        'writeoff_at' => date('Y-m-d H:i:s'),
        'audit_id' => $auditData['id']
      
      ];

      $mrSv->update($reward['id'], $updateReward);

      /**
       * 核销申请
       */
      $updateApply = [
      
        'write_off' => 1,
        'write_off_at' => date('Y-m-d H:i:s')
      
      ];

      $acctSv->update($reward['apply_id'], $updateApply);
    
    }

    return count($rewards);
  
  }

  /**
   * 审核通过
   */
  public function auditPass($data) {
  
    if ($data['id']) {
    
      return $this->update($data['id'], [ 'state' => 1 ]);
    
    } else {
    
      return 0; 
    
    }
  
  }

  public function auditFail() {
  
    if ($data['id']) {
    
      return $this->update($data['id'], [ 'state' => 2 ]);
    
    } else {
    
      return 0; 
    
    }

  }



}
