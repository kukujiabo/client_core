<?php
namespace App\Service\Merchant;

use App\Service\BaseService;
use Core\Service\CurdSv;

class ChannelPriceSv extends BaseService {

  use CurdSv;

  public function getPrice($data) {
  
    return $this->findOne([ 'channel_id' => $data['channel_id'], 'bank_id' => $data['bank_id'] ]);
  
  }

}
