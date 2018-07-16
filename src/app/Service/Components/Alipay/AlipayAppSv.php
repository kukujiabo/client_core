<?php
namespace App\Service\Components\Alipay;

use App\Library\Alipay\AlipayNotify;
use App\Service\System\ConfigSv;
use App\Library\RedisClient;

/**
 * 支付宝应用服务类
 *
 * @author Meroc Chen <398515393@qq.com> 2018-03-08
 */
class AlipayAppSv extends ConfigSv {

  protected $_partnerId; 

  protected $_safeKey;

  public function __construct($appname = 'peichong') {
  
    $this->_partnerId = $this->getConfig($appname . '_mch_id');

    $this->_safeKey = $this->getConfig($appname . '_safe_key');
  
  }

  /**
   * 支付回调处理接口
   *
   * @return string
   */
  public function paymentNotify($data) {

    $alipayConfig = [

      'partner' => $this->_partnerId,
    
      'key' => $this->_safeKey,

      'sign_type' => 'md5',

      'input_charset' => 'utf-8',

      'cacert' => API_ROOT . '/cacert.pem',

      'transport' => 'https'
    
    ];

    $alipayNotify = new AlipayNotify($alipayConfig);

    $result = $alipayNotify->verifyNotify();

    $notifyLog = new AlipayNotifyLogSv();

    if ($result) {
    
      $successDetails = $data['success_details'];

      $failedDetails = $data['fail_details'];

      $notifyLog->addLog($this->_partnerId, $this->safeKey, $successDetails, $failedDetails, 1);
    
      echo 'success';

      exit;
    
    } else {

      $notifyLog->addLog($this->_partnerId, $this->safeKey, '', '', 0);
    
      echo 'fail';

      exit;   
    
    }
  
  }

}
