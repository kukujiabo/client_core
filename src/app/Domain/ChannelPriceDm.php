<?php
namespace App\Domain;

use App\Service\Merchant\ChannelPriceSv;

class ChannelPriceDm {

  public function getPrice($data) {
  
    $cpsv = new ChannelPriceSv();
  
    return $cpsv->getPrice($data);
  
  }

}
