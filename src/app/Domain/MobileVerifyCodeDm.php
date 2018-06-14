<?php
namespace App\Domain;

use App\Service\Crm\MobileVerifyCodeSv;

/**
 * 短信验证
 *
 */
class MobileVerifyCodeDm {

  protected $_vc;

  public function __construct() {
  
    $this->_vc = new MobileVerifyCodeSv();
  
  }

  /**
   * 发送验证码
   *
   * @param string $mobile
   *
   * @return
   */
  public function sendVerifyCode($mobile) {
  
    return $this->_vc->sendVerifyCode($mobile);
  
  }

  /**
   * 校验验证码
   *
   * @param string $mobile
   * @param string $code
   *
   * @return
   */
  public function checkVerifyCode($mobile, $code) {
  
    return $this->_vc->checkVerifyCode($mobile, $code);
  
  }

}
