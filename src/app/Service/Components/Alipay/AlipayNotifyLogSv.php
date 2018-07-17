<?php
namespace App\Service\Components\Alipay;

use App\Service\BaseService;
use Core\Service\CurdSv;

/**
 * 支付宝通知日志
 *
 * @author Meroc Chen <398515393@qq.com>
 */
class AlipayNotifyLogSv extends BaseService {

  use CurdSv;

  /**
   * 添加日志
   *
   * @return int id
   */
  public function addLog($partnerId, $key, $success, $fail, $state) {
  
    $newLog = [
    
      'partner_id' => $partnerId,

      'key' => $key,

      'success' => $success,

      'fails' => $fail,

      'state' => $state,
     
      'create_at' => date('Y-m-d H:i:s')
    
    ];

    return $this->add($newLog);
  
  }

}
