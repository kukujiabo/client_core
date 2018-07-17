<?php
namespace App\Service\Components\Alipay;

use App\Service\BaseService;
use Core\Service\CurdSv;

class AlipayPayOffLogSv extends BaseService {

  use CurdSv;

  /**
   * 批量添加放款日志
   *
   */
  public function batchAddLog($batchNo, $data) {
  
    $logData = explode('|', $data);

    $batchDatas = [];
  
    foreach($logData as $log) {
    
      $parseData = explode('^', $log);

      $ids = explode(',', $parseData[4]);

      $newLog = [
      
        'batch_no' => $batchNo,

        'sequence' => $parseData[0],
        
        'account' => $parseData[1],

        'account_name' => $parseData[2],

        'money' => $parseData[3],

        'member_id' => $ids[0],

        'apply_id' => $ids[1],

        'state' => 0,

        'created_at' => date('Y-m-d H:i:s')
      
      ];

      array_push($batchDatas, $newLog);
    
    }

    return $this->batchAdd($batchDatas);
  
  }

}
