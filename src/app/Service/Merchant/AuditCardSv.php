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
  
    $auditData = $this->all([ 'write_off' => 0 ]);

    $baSv = new BankDataSv();

    $applyData = $baSv->all([ 'write_off' => 0 ]);

    $matchedApply = [];

    $dismatchApply = [];

    foreach($auditData as $audit) {
    
      foreach($applyData as $key => $apply) {

        if ($applyData[$key]['write_off'] == 1) {
        
          continue;
        
        }
      
        if ($baSv->matchData($apply, $audit)) {
        
          $applyData[$key]['write_off'] = 1;

          array_push($matchedApply, $apply['id']);
        
        }
      
      }
    
    }

    foreach($applyData as $checkedData) {
    
      array_push($dismatchApply, $checkedData['id']);
    
    }

    $mtNum = $this->batchUpdate(implode(',', $matchedApply), [ 'state' => 1, 'write_off' => 1 ]);

    $dsNum = $this->batchUpdate(implode(',', $dismatchedApply), [ 'state' => 0, 'write_off' => 1 ]);

    return [ 'matched_num' => $mtNum, 'dismatched_num' => $dsNum ];
  
  }

}
