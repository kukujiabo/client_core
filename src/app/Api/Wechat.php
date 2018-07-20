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
      
      ],

      'jsapiRegister' => [
      
        'url' => 'url|string|true||请求页面链接地址'
      
      ],

      'serverApi' => [
      
        'signature' => 'signature|string|false||签名',
        'timestamp' => 'timestamp|string|false||时间戳',
        'nonce' => 'nonce|string|false||随机串',
        'echostr' => 'echostr|string|false||验证响应字符串',
        'msg_signature' => 'msg_signature|string|false||消息签名'
      
      ],

      'createMenu' => [
      
        'menus' => 'menus|string|true||菜单'
      
      ],

      'getMenu' => [
      
      
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

  /**
   * 获取微信jsapi注册参数
   * @desc 获取微信jsapi注册参数
   *
   * @return
   */
  public function jsapiRegister() {
  
    return $this->dm->jsapiRegister($this->retriveRuleParams(__FUNCTION__));
  
  }

  /**
   * 微信服务器推送消息
   * @desc 微信服务器推送消息
   *
   * @return mixed
   */
  public function serverApi() {
  
    return $this->dm->serverApi($this->retriveRuleParams(__FUNCTION__));
  
  }

  /**
   * 创建微信公众号菜单
   * @desc 创建微信公众号菜单
   *
   * @return boolean true/false
   */
  public function createMenu() {
  
    return $this->dm->createMenu($this->retriveRuleParams(__FUNCTION__));
  
  }

  /**
   * 拉取微信公众号菜单
   * @desc 拉取微信公众号菜单
   *
   * @return mixed menu
   */
  public function getMenu() {
  
    return $this->dm->getMenu();
  
  }

}
