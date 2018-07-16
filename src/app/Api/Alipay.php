<?php
namespace App\Api;

/**
 * 支付宝接口
 *
 * @author Meroc Chen <398515393@qq.com>
 */
class Alipay extends BaseApi {

  public function getRules() {
  
    return $this->rules([
    
      'paymentNotify' => [

        'success_details' => 'success_details|string|false||付款成功详情',

        'fail_details' => 'fail_details|string|false||付款失败详情'
      
      ]
    
    ]);
  
  }

  /**
   * 支付成功回调通知
   * @desc 支付成功回调通知
   *
   * @return string 
   */
  public function paymentNotify() {
  
    return $this->dm->paymentNotify($this->retriveRuleParams(__FUNCTION__)); 
  
  }

}
