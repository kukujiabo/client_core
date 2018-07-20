<?php
namespace App\Service\Components\Wechat;

use App\Library\RedisClient;
use App\Library\Http;

/**
 * 微信权限服务
 *
 * @author Meroc Chen <398515393@qq.com> 2018-03-08
 */
class WechatAuth {

  /**
   * 获取微信jsapi_ticket
   *
   * @param string appid
   * @param string appsecret
   * @param boolean refresh
   *
   * @return string ticket
   */
  public static function getJsTicket($appid, $appsecret, $refresh = false) {

    $ticket = RedisClient::get('wechat_jsapi_ticket', $appid);

    if (!$ticket || !$ticket->ticket || $ticket->expire_at < time() || $refresh) {
  
      $accessToken = self::getAccessTokenByAppIdAppSecret($appid, $appsecret);

      $url = str_replace('{ACCESS_TOKEN}', $accessToken , WechatApi::GET_JSAPI_TICKET);

      $jsapiTicket = json_decode(Http::httpGet($url));

      if ($jsapiTicket->errcode == 0) {
      
        $newTicket = [
        
          'ticket' => $jsapiTicket->ticket,

          'expire_at' => $jsapiTicket->expires_in + time()
        
        ];

        RedisClient::set('wechat_jsapi_ticket', $appid, $newTicket);

        return $jsapiTicket->ticket;
      
      } else {
      
        return 0;
      
      }

    } else {
    
      return $ticket->ticket;
    
    }
  
  }

  /**
   * 获取微信公众号接口访问令牌
   *
   * @param string appid
   * @param string appsecret
   * @param string code
   *
   * @return
   */
  public static function getPubAccessToken($appid, $appsecret, $code) {

    $url = str_replace(array('{APPID}', '{APPSECRET}', '{CODE}'), array($appid, $appsecret, $code), WechatApi::USER_ACCESS_TOKEN);

    $result = json_decode(Http::httpGet($url));  

    if ($result->errcode) {
    
      //todo record error.
    
    }
    
    return $result;
  
  }

  /**
   * 获取小程序微信接口访问令牌
   *
   * @param string appid
   * @param string appsecret
   *
   * @return
   */
  public static function getAccessTokenByAppIdAppSecret($appid, $appsecret, $refresh = false) {

    $accessToken = RedisClient::get('wechat_auth', $appid);

    if (!$accessToken || !$accessToken->access_token || $accessToken->expire_at < time() || $refresh) {

      $url = str_replace(array('{APPID}', '{APPSECRET}'), array($appid, $appsecret), WechatApi::GET_ACCESS_TOKEN);

      $result = json_decode(Http::httpGet($url));  

      if ($result->errcode) {
      
        //todo record error.
      
      }
      
      $newAccessToken = [
      
        'access_token' => $result->access_token,

        'expire_at' => time() + $result->expires_in - 5
      
      ];

      RedisClient::set('wechat_auth', $appid, $newAccessToken);

      if ($result->openid) {

        return $result;

      } else {

        return $result->access_token;

      }

    } else {
    
      return $accessToken->access_token;
    
    }
  
  }



  /**
   * 获取用户openid
   *
   * @param string appid
   * @param string appsecret
   * @param string code
   *
   * @return
   */
  public static function getOpenId($appid, $appsecret, $code) {
  
    /**
     * 读取配置url
     */
    $url = str_replace(

      array('{APPID}', '{APPSECRET}', '{CODE}'), 

      array($appid, $appsecret, $code), 

      WechatApi::GET_MIN_OPENID

    );
  
    $result = json_decode(Http::httpGet($url));

    if ($result->errcode) {
    
      //todo handle api error
    
    }

    return $result;

  }

  /**
   * 查询用户信息
   *
   * @param string accessToken
   * @param string openid
   *
   * @return
   */
  public static function getUserInfo($accessToken, $openid) {
  
    /**
     * 读取配置url
     */
    $url = str_replace(

      array('{ACCESS_TOKEN}', '{OPENID}'), 

      array($accessToken, $openid), 

      WechatApi::DEVELOPER_WECHAT_ONER_USER_INFO

    );
  
    $result = json_decode(Http::httpGet($url));

    if ($result->errcode) {
    
      //todo handle api error
    
    }

    return $result;
  
  }

  /**
   * 查询注册用户信息
   *
   * @param string accessToken
   * @param string openid
   *
   * @return
   */
  public static function getRegUserInfo($accessToken, $openid) {
  
    /**
     * 读取配置url
     */
    $url = str_replace(

      array('{ACCESS_TOKEN}', '{OPENID}'), 

      array($accessToken, $openid), 

      WechatApi::GET_SUBSCRIBE

    );
  
    $result = json_decode(Http::httpGet($url));

    if ($result->errcode) {
    
      //todo handle api error
    
    }

    return $result;
  
  }

  /**
   * 微信服务器认证
   *
   * @return boolean true/false
   */
  public function checkServAuth($data, $token) {

    $waclSv = new WechatAuthCheckLogSv();

    $log = [
    
      'signature' => $data['signature'],
      'nonce' => $data['nonce'],
      'timestamp' => $data['timestamp'],
      'echostr' => $data['echostr'],
      'token' => $token,
      'created_at' => date('Y-m-d H:i:s'),
    
    ];

    $waclSv->add($log);
  
    $tmpArr = [ $data['timestamp'], $data['nonce'], $token ];

    sort($tmpArr, SOTR_STRING);

    $tmpStr = implode($tmpArr);
  
    $sign = sha1($tmpStr);

    return $data['signature'] == $sign;
  
  }


}
