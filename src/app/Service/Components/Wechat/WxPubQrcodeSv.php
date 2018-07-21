<?php
namespace App\Service\Components\Wechat;

use App\Service\BaseService;
use Core\Service\CurdSv;

/**
 * 微信公众号推广二维码
 *
 */
class WxPubQrcodeSv extends BaseService {

  use CurdSv;

  public function create($memberId, $reference, $ticket, $expireTime) {
  
    $newQrcode = [
    
      'member_id' => $memberId,

      'reference' => $reference,

      'ticket' => $ticket,
    
      'expire_time' => $expireTime,

      'active' => 1,

      'created_at' => date('Y-m-d H:i:s')
    
    ];

    return $this->add($newQrcode);
  
  }

}
