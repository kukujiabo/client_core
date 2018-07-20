<?php
namespace App\Service\Components\Wechat;

use App\Service\BaseService;
use App\Library\Http;

/**
 * 微信菜单服务
 *
 * @author Meroc Chen <398515393@qq.com> 2017-12-17
 */
class WechatMenuSv extends BaseService {

  /**
   * 创建微信公众号菜单
   *
   * @param array $menuData
   *
   * @return boolean true/false
   */
  public function create($data, $appid, $appsecret) {
  
    $accessToken = WechatAuth::getAccessTokenByAppIdAppSecret($appid, $appsecret);

    $url = str_replace('{ACCESS_TOKEN}', $accessToken, WechatApi::CREATE_WPS_MENU);

    $result = Http::httpPost($url, $data['menus']);

    if ($result) {
    
      $resultArray = json_decode($result, true);

      if (empty($resultArray) || !empty($resultArray['errcode'])) {

        $this->throwError($this->_err->MENU_CREATE_RESPONSE_PARSE_MSG, $this->_err->MENU_CREATE_RESPONSE_PARSE_CODE)
      
      } elseif ($resultArray['errcode'] == 0) {

        return true;
      
      }

    } else {
    
      $this->throwError($this->_err->MENUCREATEFAILMSG, $this->_err->MENUCREATEFAILCODE)
    
    }
  
  }

  /**
   * 拉取微信公众号菜单
   *
   * @return array list
   */
  public function getMenu($appid, $appsecret) {
  
    $accessToken = WechatAuth::getAccessTokenByAppIdAppSecret($appid, $appsecret);

    $url = str_replace('{ACCESS_TOKEN}', $accessToken, WechatApi::GET_WPS_MENU);

    return Http::httpGet($url);
  
  }

}
