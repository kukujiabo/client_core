<?php
namespace App\Service\Components\Wechat;

use App\Library\Http;
use App\Library\WXBizMsgCrypt;
use App\Service\Components\Qiniu\QiniuSv;

/**
 * 微信工具类
 *
 * @author Meroc Chen <398515393@qq.com>
 */
class WechatTools {

  /**
   * 获取微信 获取小程序码（临时场景）
   *
   * @param string accessToken
   *
   * @return string bytes of image
   */
  public function getMiniTempCode($accessToken, $scene, $page, $width = 400, $autoColor = true, $lineColor = [ "r" => 0, "g" => 0, "b" => 0]) {
  
    $url = str_replace( '{ACCESS_TOKEN}', $accessToken, WechatApi::GET_SMALL_PROGRAM_CODE );

    $data = [
    
      'scene' => $scene,

      'path' => $page,

      'width' => $width,

      'auto_color' => $autoColor,

      'line_color' => $lineColor
    
    ];

    $params = json_encode($data);
  
    $img = Http::httpPost($url, $params, null, null, null, 'raw');

    return file_put_contents(API_ROOT . '/codes/' . time(). '.jpg', $img);

  
  }

  /**
   * 解析微信消息
   *
   */
  public function decodeXMLMessage($content, $sign, $time, $nonce, $appid, $token, $aesKey, $logId) {
  
    $pc = new WXBizMsgCrypt($token, $aesKey, $appid);

    $msg = '';

    $errCode = $pc->decryptMsg($sign, $time, $nonce, $content, $msg);

    $wmlSv = new WechatMessageLogSv();

    if ($errCode != 0) {

      $wmlSv->update($logId, [ 'err_code' => $errCode, 'state' => -1 ]);
    
      return false;
    
    } else {

      $wmlSv->update($logId, [ 'err_code' => 0, 'state' => 1, 'decoded_message' => $msg ]);

      return $msg;

    }

  }

  /**
   * 获取带参数的二维码
   *
   * @return 
   */
  public function createTmpQrcode($scene, $appid, $appsecret) {
  
    $codeData = [
    
      'expire_seconds' => 2592000,

      'action_name' => 'QR_STR_SCENE',
    
      'action_info' => [ "scene" => [ "scene_str" => $scene ] ]
    
    ];
  
    $postData = json_encode($codeData);

    $accessToken = WechatAuth::getAccessTokenByAppIdAppSecret($appid, $appsecret);

    $url = str_replace( '{ACCESS_TOKEN}', $accessToken, WechatApi::GET_TICKET );

    return Http::httpPost($url, $postData, '', '', 5000, 'raw');
  
  }

}
