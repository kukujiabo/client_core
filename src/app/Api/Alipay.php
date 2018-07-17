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
      
      ],

      'payOff' => [

        'payee_account' => 'payee_account|string|true||收款方账号',
        'amount' => 'amount|string|true||支付金额',
        'payer_show_name' => 'payer_show_name|string|true||收据内容',
        'payee_real_name' => 'payee_real_name|string|true||收款方真实姓名',
        'remark' => 'remark|string|true||备注'
      
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

  /**
   * 批量支付接口
   * @desc 批量支付接口
   *
   * @return string
   */
  public function payOff() {
  
    return $this->dm->payOff($this->retriveRuleParams(__FUNCTION__));
  
  }

}
