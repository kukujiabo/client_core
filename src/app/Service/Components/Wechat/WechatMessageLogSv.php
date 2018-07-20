<?php
namespace App\Service\Component\Wechat;

use App\Service\BaseService;
use Core\Service\CurdSv;

/**
 * 微信推送消息日志
 *
 */
class WechatMessageLogSv extends BaseService {

  use CurdSv;

  public function addLog($raw) {
  
    $newLog = [
    
      'raw' => $raw,

      'state' => 0,

      'created_at' => date('Y-m-d H:i:s')
    
    ];

    return $this->add($raw);
  
  }

}
