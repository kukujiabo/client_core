<?php
namespace App\Domain;

use App\Service\Components\Wechat\WechatAppSv;
use App\Service\Merchant\MerchantSv;

class TestDm {

  protected $_wxAppSv;

  protected $_merchant;

  public function __construct() {
  
    $this->_wxAppSv = new WechatAppSv();

    $this->_merchant = new MerchantSv();
  
  }

  public function testWechatMiniTempCode() {
  
    return $this->_wxAppSv->getMiniTempCode(1, '/pages/index/index', 400, true, [ "r" => 0, "g" => 0, "b" => 0]);
  
  }

  public function testMiniProgramUploadToQiniu() {
  
    return $this->_merchant->getMerchantTempCode();
  
  }

}
