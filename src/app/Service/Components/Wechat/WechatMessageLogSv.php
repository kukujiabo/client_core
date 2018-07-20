<?php
namespace App\Service\Components\Wechat;

use App\Service\BaseService;
use Core\Service\CurdSv;

/**
 * 微信推送消息日志
 *
 */
class WechatMessageLogSv extends BaseService {

  use CurdSv;

  public function addLog($raw, $signature, $timestamp, $nonce) {
  
    $newLog = [

      'msg_signature' => $signature,

      'timestamp' => $timestamp,

      'nonce' => $nonce,
    
      'raw' => $raw,

      'state' => 0,

      'created_at' => date('Y-m-d H:i:s')
    
    ];

    return $this->add($raw);
  
  }

}
