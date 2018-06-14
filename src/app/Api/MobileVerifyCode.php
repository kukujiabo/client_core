<?php
namespace App\Api; 
/**
 * 验证码接口
 *
 * @author Meroc Chen <398515393@qq.com> 2018-01-30
 */
class MobileVerifyCode extends BaseApi {

  public function getRules() {

    return $this->rules(array(
    
      'sendVerifyCode' => array(
      
        'mobile' => 'mobile|string|true||会员手机号'

      ),

      'checkVerifyCode' => array(
      
        'mobile' => 'mobile|string|true||手机号',

        'code' => 'code|string|true||验证码'
      
      )
    
    ));

  }

  /**
   * 发送验证码
   * @desc 发送验证码
   *
   * @return array 发送返回
   * @return string array.status 发送状态，success 表示成功
   */
  public function sendVerifyCode() {

    $params = $this->retriveRuleParams(__FUNCTION__);
  
    return $this->dm->sendVerifyCode($params['mobile']);
  
  }

  /**
   * 校验验证码
   * @desc 校验验证码
   *
   * @return int 校验结果
   */
  public function checkVerifyCode() {
   
    $params = $this->retriveRuleParams(__FUNCTION__);

    return $this->dm->checkVerifyCode($params['mobile'], $params['code']);
  
  }


}
