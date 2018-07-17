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

      'batchPayOff' => [
      
        'batch_fee' => 'batch_fee|float|true||支付总费用',
        'batch_num' => 'batch_num|int|true||支付费用笔数',
        'batch_no' => 'batch_no|string|true||批次号',
        'detail_data' => 'detail_data|string|true||支付明细'
      
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
  public function batchPayOff() {
  
    return $this->dm->batchPayOff($this->retriveRuleParams(__FUNCTION__));
  
  }

}
