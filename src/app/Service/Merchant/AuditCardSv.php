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
  
    $auditData = $this->all([ 'sequence' => $data['sequence'] ]);

    $baSv = new BankDataSv();

    $bsaSv = new BusinessApplySv();

    $applyData = $bsaSv->all([ 'write_off' => 0, 'bank_id' => $data['bank_id'] ]);

    $matchedAudit = [];

    $dismatchAudit = [];

    $matchedApply = [];

    $dismatchApply = [];

    foreach($auditData as $key1 => $audit) {
    
      foreach($applyData as $key2 => $apply) {

        if ($apply['write_off'] == 1) {
        
          continue;
        
        }
      
        if ($baSv->matchData($apply, $audit)) {
        
          $applyData[$key2]['write_off'] = 1;

          $auditData[$key1]['write_off'] = 1;

          array_push($matchedAudit, $audit['id']);

          array_push($matchedApply, $apply['id']);

          break;
        
        }
      
      }
    
    }

    foreach($applyData as $checkedData) {

      if (!$checkedData['write_off']) {
    
        array_push($dismatchApply, $checkedData['id']);

      }
    
    }

    foreach($auditData as $checkedData) {
    
      if (!$checkedData['write_off']) {
      
        array_push($dismatchAudit, $checkedData['id']);
      
      } 
    
    }

    $mtNum = $this->batchUpdate(implode(',', $matchedApply), [ 'state' => 1, 'write_off' => 1 ]);

    $dsNum = $this->batchUpdate(implode(',', $dismatchedApply), [ 'state' => 0, 'write_off' => 1 ]);

    return [ 'matched_num' => $mtNum, 'dismatched_num' => $dsNum ];
  
  }

}
