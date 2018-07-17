<?php
namespace App\Service\Components\Alipay;

use App\Service\BaseService;
use Core\Service\CurdSv;

class AlipayPayOffLogSv extends BaseService {

  use CurdSv;

  public function addLog($outNo, $amount, $payerShowName, $payeeRealName, $remark, $relatId, $relatType) {
  
    $newLog = [
    
      'out_no' => $outNo,
      'payee_account' => $payeeAcct,
      'amount' => $amount,
      'payer_show_name' => $payerShowName,
      'payee_real_name' => $payeeRealName,
      'remark' => $remark,
      'relat_id' => $relatId,
      'relat_type' => $relatType,
      'state' => 0,
      'created_at' => date('Y-m-d H:i:s')
    
    ];

    return $this->add($newLog);
  
  }

}
