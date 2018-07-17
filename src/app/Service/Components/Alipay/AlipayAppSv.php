<?php
namespace App\Service\Components\Alipay;

use App\Library\Alipay\AlipayNotify;
use App\Service\System\ConfigSv;
use App\Library\RedisClient;
use App\Library\Http;
use App\Library\Alipay\AlipaySubmit;

/**
 * 支付宝应用服务类
 *
 * @author Meroc Chen <398515393@qq.com> 2018-03-08
 */
class AlipayAppSv extends ConfigSv {

  protected $_partnerId; 

  protected $_safeKey;

  protected $_notifyUrl;

  protected $_merchantAccount;

  protected $_merchantName;

  protected $_alipayConfig;

  public function __construct($appname = 'peichong') {
  
    $this->_partnerId = $this->getConfig($appname . '_mch_id');

    $this->_safeKey = $this->getConfig($appname . '_safe_key');

    $this->_notifyUrl = $this->getConfig($appname . '_ali_notify_url');

    $this->_merchantAccount = $this->getConfig($appname . '_ali_mch_acct');

    $this->_merchantName = $this->getConfig($appname . '_ali_mch_name');

    $this->_alipayConfig = [

      'partner' => $this->_partnerId,
    
      'key' => $this->_safeKey,

      'sign_type' => 'md5',

      'input_charset' => 'utf-8',

      'cacert' => API_ROOT . '/cacert.pem',

      'transport' => 'https'
    
    ];
  
  }

  /**
   * 支付回调处理接口
   *
   * @return string
   */
  public function paymentNotify($data) {

    $alipayNotify = new AlipayNotify($this->_alipayConfig);

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

  /**
   * 批量支付
   *
   * @return 
   */
  public function batchPayOff($data) {

    $dateStr = date('Ymd');
  
    $payOffParams = [
    
      'service' => 'batch_trans_notify',

      'partner' => $this->_partnerId,

      'notify_url' => $this->_notifyUrl,

      'email' => $this->_merchantAccount,

      'account_name' => 'account_name',

      'pay_date' => $dateStr,

      'batch_no' => $dateStr . $data['batch_no'],

      'batch_fee' => $data['batch_fee'],

      'batch_num' => $data['batch_num'],

      'detail_data' => $data['detail_data'],

      '_input_charset' => 'utf-8'
    
    ];


    /**
     * 参数写入日志
     */
    $batchLog = new AlipayBatchPayLogSv();

    $batchLog->add($payOffParams);

    $alipaySubmit = new AlipaySubmit($this->_alipayConfig);

    /**
     * 添加单个放款日志
     */
    $payOffLogs = new AlipayPayOffLogSv();

    $payOffLogs->batchAddLog($payOffParams['batch_no'], $data['detail_data']);

    /**
     * 发送请求
     */
    return $alipaySubmit->buildRequestHttp($payOffParams);
  
  }

}
