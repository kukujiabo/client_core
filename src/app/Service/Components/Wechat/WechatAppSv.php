<?php
namespace App\Service\Components\Wechat;

use App\Service\System\ConfigSv;
use App\Library\RedisClient;

/**
 * 微信应用服务类
 *
 * @author Meroc Chen <398515393@qq.com> 2018-03-08
 */
class WechatAppSv extends ConfigSv {

  protected $_appid;

  protected $_appsecret;

  public function __construct($appName = 'cloud_credit') {
  
    $this->_appid = $this->getConfig("{$appName}_appid");

    $this->_appsecret = $this->getConfig("{$appName}_appsecret");
  
  }

  /**
   * 添加应用配置
   *
   * @param string appName
   * @param string appId
   * @param string appSecret
   *
   * @return
   */
  public function editAppConf($appName, $appId, $appSecret, $title) {
  
    $res1 = $this->editConfig('wechat', 'app', "{$appName}_appid", $appId, $title);

    $res2 = $this->editConfig('wechat', 'app', "{$appName}_appsecret", $appSecret, $title);

    return $res1 || $res2;
  
  }

  /**
   * 获取微信访问令牌
   *
   * @return string accessToken
   */
  public function getAccessToken($type = 'pub', $refresh = false, $code = '') {

    if ($type == 'pub') {
    
      return WechatAuth::getPubAccessToken($this->_appid, $this->_appsecret, $code);  
    
    } else {
  
      return WechatAuth::getMiniAccessToken($this->_appid, $this->_appsecret, $refresh);  

    }
  
  }

  /**
   * 获取openid
   *
   * @param string code
   *
   * @return object
   */
  public function getOpenId($code) {
  
    return WechatAuth::getOpenId($this->_appid, $this->_appsecret, $code);
  
  }

  /**
   * 获取微信小程序二维码
   *
   * @param string 
   *
   * @return object
   */
  public function getMiniTempCode($scene, $page, $width, $autoColor, $lineColor) {

    $accessToken = self::getAccessToken();

    return WechatTools::getMiniTempCode(self::getAccessToken(), $scene, $page, $width, $autoColor, $lineColor);
  
  }

}
