<?php
namespace App\Service\Components\Wechat;

use App\Library\Http;
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


}
