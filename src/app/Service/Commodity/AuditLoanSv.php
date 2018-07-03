<?php
namespace App\Service\Commodity;

use App\Service\BaseService;
use App\Service\Merchant\BusinessApplySv;
use Core\Service\CurdSv;


class AuditLoanSv extends BaseService {

  use CurdSv;


  /**
   * 对账数据
   *
   * @return array num
   */
  public function balanceOfAccount($data) {
  
    $auditData = $this->all([ 'sequence' => $data['sequence'], 'write_off' => 0, 'counted' => 0 ], 'id desc');

    $loSv = new LoanDataSv();

    $bsaSv = new BusinessApplySv();

    $loanData = $loSv->findOne([ 'sequence' => $data['sequence'] ]);

    $applyData = $bsaSv->all([ 'state' => 0, 'relat_id' => $data['loan_id'], 'type' => 'loan' ], 'id desc');

    $matchedAudit = [];

    $matchedApply = [];

    $dismatchApply = [];

    foreach($auditData as $key1 => $audit) {
    
      foreach($applyData as $key2 => $apply) {

        if ($apply['write_off'] == 1) {
        
          continue;
        
        }
      
        if ($loSv->matchData($apply, $audit)) {
        
          $applyData[$key2]['write_off'] = 1;

          array_push($matchedAudit, $audit['id']);

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

    $loSv->update($loanData['id'], [ 'state' => 2, 'checked_at' => date('Y-m-d H:i:s') ]);

    return [ 'matched_audit' => $mtNum, 'pass_apply' => $mtApp, 'reject_apply' => $dmtApp ];
  
  }

}
