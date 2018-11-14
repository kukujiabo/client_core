<?php
namespace App\Service\Merchant;

use App\Service\BaseService;
use Core\Service\CurdSv;

/**
 * 信用卡审核数据
 *
 * @author Meroc Chen
 */
class AuditCardSv extends BaseService {

  use CurdSv;

  /**
   * 查询脱敏数据
   */
  public function getList($data) {
  
    $vacSv = new VAuditBankCardSv();

    $query = [];

    if ($data['sequence']) {
    
      $query['sequence'] = $data['sequence'];
    
    }
    if ($data['source']) {
    
      $query['source'] = $data['source'];
    
    }
    if ($data['bank_id']) {
    
      $query['bank_id'] = $data['bank_id'];
    
    }

    return $vacSv->queryList($query, $data['fields'], $data['order'], $data['page'], $data['page_size']);
  
  }

  /**
   * 对账
   *
   */
  public function balanceOfAccount($data) {
  
    $auditData = $this->all([ 'sequence' => $data['sequence'], 'write_off' => 0, 'counted' => 0 ], 'id desc');

    $baSv = new BankDataSv();

    $bsaSv = new BusinessApplySv();

    $bankData = $baSv->findOne([ 'sequence' => $data['sequence'] ]);

    $applyData = $bsaSv->all([ 'state' => 0, 'bank_id' => $data['bank_id'] ], 'id desc');

    $matchedAudit = [];

    $matchedApply = [];

    $dismatchApply = [];

    foreach($auditData as $key1 => $audit) {
    
      foreach($applyData as $key2 => $apply) {

        if ($apply['write_off'] == 1) {
        
          continue;
        
        }
      
        if ($baSv->matchData($apply, $audit)) {
        
          $applyData[$key2]['write_off'] = 1;

          array_push($matchedAudit, $audit['id']);

          $this->update($audit['id'], [ 'apply_id' => $apply['id'] ]);

          if ($audit['state'] == 1) {

            /**
             * 审批通过
             */

            array_push($matchedApply, $apply['id']);

          } else {

            /**
             * 审批拒绝
             */ 

            array_push($dismatchApply, $apply['id']);
          
          
          }

          break;
        
        }
      
      }
    
    }

    $mtNum = 0; $mtApp = 0; $dmtApp = 0;

    if (!empty($matchedAudit)) {
    
      $mtNum = $this->batchUpdate([ 'id' => implode(',', $matchedAudit) ], [ 'counted' => 1 ]);
    
    }
    if (!empty($matchedApply)) {
    
      $mtApp = $bsaSv->batchUpdate([ 'id' => implode(',', $matchedApply) ], [ 'state' => 1, 'checked_at' => date('Y-m-d H:i:s') ]);
     
    }
    if (!empty($dismatchApply)) {
    
      $dmtApp = $bsaSv->batchUpdate([ 'id' => implode(',', $dismatchApply) ], [ 'state' => 2, 'checked_at' => date('Y-m-d H:i:s') ]);
    
    }

    $baSv->update($bankData['id'], [ 'state' => 2, 'checked_at' => date('Y-m-d H:i:s') ]);

    return [ 'matched_audit' => $mtNum, 'pass_apply' => $mtApp, 'reject_apply' => $dmtApp ];
  
  }

}
