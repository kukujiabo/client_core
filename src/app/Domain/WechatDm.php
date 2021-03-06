<?php
namespace App\Domain;

use App\Service\Components\Wechat\WechatAppSv;

class WechatDm {

  protected $_wxsv;

  public function __construct() {
  
    $this->_wxsv = new WechatAppSv();
  
  }

  /**
   * 编辑微信应用配置
   */
  public function editAppConf($appName, $appid, $appsecret, $title) {
  
    return $this->_wxsv->editAppConf($appName, $appid, $appsecret, $title); 

  }

  /**
   * 读取微信访问令牌
   */
  public function getAccessToken() {
  
    return $this->_wxsv->getAccessToken();
  
  }

  /**
   * 获取openID
   */
  public function getOpenId($code) {
  
    return $this->_wxsv->getOpenId($code);
  
  }

  /**
   * 微信小程序登录
   */
  public function wechatMiniLogin($appName, $code) {
  
    return $this->_wxsv->wechatMiniLogin($appName, $code);
  
  }

  /**
   * 微信jsapi注册
   */
  public function jsapiRegister($params) {
  
    return $this->_wxsv->jsapiRegister($params['url']);
  
  }

  public function serverApi($params) {
  
    return $this->_wxsv->serverApi($params);
  
  }

  public function createMenu($params) {
  
    return $this->_wxsv->createMenu($params);
  
  }

  public function getMenu() {
  
    return $this->_wxsv->getMenu();
  
  }

  public function createTmpQrcode($data) {
  
    return $this->_wxsv->createTmpQrcode($data['scene']);
  
  }

  public function getPubTmpQrcode($data) {
  
    return $this->_wxsv->getPubTmpQrcode($data);
  
  }

}
