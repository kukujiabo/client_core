<?php
namespace App\Api;

/**
 * 微信服务接口
 *
 * @author Meroc Chen <398515393@qq.com> 2018-03-26
 */
class Wechat extends BaseApi {

  public function getRules() {
  
    return $this->rules([
    
      'editAppConf' => [
      
        'app_name' => 'app_name|string|true||应用名称',

        'appid' => 'appid|string|true||应用appid',

        'appsecret' => 'appsecret|string|true||应用appsecret',

        'title' => 'title|string|true||应用说明'
      
      ],

      'getAccessToken' => [
      
      ],

      'getOpenId' => [

        'code' => 'code|string|true||微信code'
      
      ]
      
    ]);
  
  }

  /**
   * 编辑微信应用配置
   * @desc 编辑微信应用配置
   *
   * @return 
   */
  public function editAppConf() {
  
    $params = $this->retriveRuleParams(__FUNCTION__);

    return $this->dm->editAppConf($params['app_name'], $params['appid'], $params['appsecret'], $params['title']);
  
  }

  /**
   * 获取微信访问令牌
   * @desc 获取微信访问令牌
   *
   * @return
   */
  public function getAccessToken() {
  
    return $this->dm->getAccessToken();
  
  }

  /**
   * 获取微信用户openid
   * @desc 获取微信用户openid
   *
   * @return
   */
  public function getOpenId() {

    $params = $this->retriveRuleParams(__FUNCTION__);
  
    return $this->dm->getOpenId($params['code']);
  
  }

}
