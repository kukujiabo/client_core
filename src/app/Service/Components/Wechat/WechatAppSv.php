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

  protected $_aesKey;

  protected $_servToken;

  public function __construct($appName = 'cloud_credit') {
  
    $this->_appid = $this->getConfig("{$appName}_appid");

    $this->_appsecret = $this->getConfig("{$appName}_appsecret");

    $this->_aesKey = $this->getConfig("wx_serv_aesKey");

    $this->_servToken = $this->getConfig("wx_serv_token");
  
  }

  /**
   * 微信服务器接口
   *
   * @param string data.signature
   * @param string data.nonce
   * @param string data.timestamp
   * @param string data.echostr
   *
   * @return mixed
   */
  public function serverApi($data) {
  
    /**
     * 判断是否服务器验证
     */
    if ($data['echostr'] && $data['signature']) {
    
      if (WechatAuth::checkServAuth($data, $this->_servToken)) {
      
        echo $data['echostr'];
        
        exit;
      
      } else {
      
        echo 'fail';

        exit;
      
      }
    
    }
    
    /**
     * 获取消息具体内容
     */
    $raw = file_get_contents('php://input');

    /**
     * 保存消息内容
     */

    $wmLSv = new WechatMessageLogSv();

    $logId = $wmLSv->addLog($raw);

    /**
     * 解析微信加密数据
     */
    $msg = WechatTools::decodeXMLMessage( $raw, $data['msg_signature'], $data['timestamp'], $data['nonce'], $this->_appid, $this->_servToken, $this->_aesKey, $logId );

    if ($msg) { 

      /**
       * 解析成功
       */
    
    }


    /**
     * 返回空字符串
     */

    echo '';

    exit;
    
  
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
  
      return WechatAuth::getAccessTokenByAppIdAppSecret($this->_appid, $this->_appsecret, $refresh);  

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
   * 获取用户信息
   *
   * @param string accessToken
   * @param string openid
   *
   * @return object
   */
  public function getUserInfo($accessToken, $openid) {
  
    return WechatAuth::getUserInfo($accessToken, $openid);
  
  }

  /**
   * 获取用户注册信息
   *
   * @param string accessToken
   * @param string openid
   *
   * @return object
   */
  public function getRegUserInfo($accessToken, $openid) {
  
    return WechatAuth::getRegUserInfo($accessToken, $openid);
  
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

  /**
   * 微信api接口
   *
   * @param string url
   *
   * @return
   */
  public function jsapiRegister($url) {

    $timeStamp = time();

    $jsapiTicket = WechatAuth::getJsTicket($this->_appid, $this->_appsecret);
  
    $signStr = "jsapi_ticket={$jsapiTicket}&noncestr=cloudcredit&timestamp={$timeStamp}&url={$url}";

    $signature = sha1($signStr);
  
    $result = [
    
      'timestamp' => $timeStamp,

      'signature' => $signature,

      'noncestr' => 'cloudcredit',

      'appid' => $this->_appid
    
    ];

    return $result;
  
  }

}
