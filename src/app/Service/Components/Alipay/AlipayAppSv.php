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

  public function payOff($data) {

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

    $bizContent = [
    
      'out_biz_no' => $this->createOutNo(),
      'payee_type' => 'ALIPAY_LOGONID',
      'payee_account' => $data['payee_account'],
      'amount' => $data['amount'],
      'payer_show_name' => $data['payer_show_name'],
      'payee_real_name' => $data['payee_real_name'],
      'remark' => $data['remark']
    
    ];

    $request->setBizContent( json_encode( $bizContent ) );

    $result = $aop->execute ( $request ); 

    $responseNode = str_replace(".", "_", $request->getApiMethodName()) . "_response";

    $resultCode = $result->$responseNode->code;

    if(!empty($resultCode)&&$resultCode == 10000){

      return "成功";

    } else {

      return "失败";

    }

  }

  public function createOutNo() {

    $rdStr = \App\getRandomString(4);
  
    return $rdStr . time() . rand(10000, 99999);
  
  }

}
