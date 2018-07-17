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

  protected $_appid; 

  protected $_rsaPriKey;

  protected $_rsaPubKey;

  public function __construct($appname = 'peichong') {
  
    $this->_appid = $this->getConfig($appname . '_app_id');

    $this->_rsaPriKey = $this->getConfig($appname . '_rsa_private_key');

    $this->_rsaPubKey = $this->getConfig($appname . '_rsa_public_key');

  }

  public function payOff($data, $relatId, $relatType) {

    $aop = new \AopClient();

    $aop->gatewayUrl = AlipayApi::OPENAPI;

    $aop->appId = $this->_appid;

    $aop->rsaPrivateKey = $this->_rsaPriKey;

    $aop->alipayrsaPublicKey = $this->_rsaPubKey;

    $aop->apiVersion = '1.0';

    $aop->signType = 'RSA2';

    $aop->postCharset='utf-8';

    $aop->format='json';

    $request = new \AlipayFundTransToaccountTransferRequest ();

    $outNo = $this->createOutNo();

    $bizContent = [
    
      'out_biz_no' => $outNo,
      'payee_type' => 'ALIPAY_LOGONID',
      'payee_account' => $data['payee_account'],
      'amount' => $data['amount'],
      'payer_show_name' => $data['payer_show_name'],
      'payee_real_name' => $data['payee_real_name'],
      'remark' => $data['remark']
    
    ];

    $request->setBizContent( json_encode( $bizContent ) );

    $apolSv = new AlipayPayOffLogSv();

    $logId = $apolSv->addLog($outNo, $data['payee_account'], $data['amount'], $data['payer_show_name'], $data['payee_real_name'], $data['remark'], $relatId, $relatType);

    $result = $aop->execute ( $request ); 

    $responseNode = str_replace(".", "_", $request->getApiMethodName()) . "_response";

    $resultCode = $result->$responseNode->code;

    if(!empty($resultCode)&&$resultCode == 10000){

      $success = [
      
        'state' => 1,

        'order_id' => $result->$responseNode->order_id,

      ];

      $apolSv->update($logId, $success);

      return true;

    } else {

      $err = [
      
        'state' => -1,

        'err_msg' => $result->$responseNode->msg,

        'err_code' => $resultCode,

        'sub_code' => $result->$responseNode->sub_code,

        'sub_msg' => $result->$responseNode->sub_msg
      
      ];

      $apolSv->update($logId, $err);

      return false;

    }

  }

  public function createOutNo() {

    $rdStr = \App\getRandomString(4);
  
    return $rdStr . time() . rand(10000, 99999);
  
  }

}
