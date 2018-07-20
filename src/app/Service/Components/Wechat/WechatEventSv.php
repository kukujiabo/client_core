<?php
namespace App\Service\Components\Wechat;

use App\Service\BaseService;
use App\Service\Crm\MemberSv;
use Core\Service\CurdSv;

/**
 * 微信事件处理服务
 *
 */
class WechatEventSv extends BaseService {

  use CurdSv;

  /**
   * 新建事件处理
   */
  public function create($event, $logId) {
  
    $newEvt = [
    
      'evnt' => $event,

      'log_id' => $logId,

      'state' => 0,

      'created_at' => date('Y-m-d H:i:s')
    
    ];

    return $this->add($newEvt);
  
  }

  /**
   * 处理关注事件
   */
  public function subscribe($xml, $appid, $appsecret, $evtId) {

    /**
     * 通过openId 获取用户基本信息
     */
    $openId = $xml->getElementsByTagName('FromUserName')->item(0)->nodeValue;

    $accessToken = WechatAuth::getAccessTokenByAppIdAppSecret($appid, $appsecret);

    $wxMember = WechatAuth::getRegUserInfo($accessToken, $openId);

    /**
     * 获取渠道信息（无渠道信息为空）
     */
    $reference = $xml->getElementsByTagName('EventKey')->item(0)->nodeValue;

    /**
     * 保存用户基本信息
     */
    $memberSv = new MemberSv();

    if ($memberSv->wechatSubscribe($wxMember, $reference)) {
    
      $this->update($evtId, [ 'state' => 1, 'relat' => $wxMember->unionid ]);
     
    } else {
    
      $this->update($evtId, [ 'state' => -1, 'relat' => $wxMember->unionid ]);
    
    }
  
  }

  /**
   * 用户取消关注事件
   */
  public function unsubscribe($xml, $appid, $appsecret, $evtId) {
  
    $openId = $xml->getElementsByTagName('FromUserName')->item(0)->nodeValue;

    $memberSv = new MemberSv();
  
    $member = $memberSv->findOne([ 'wx_pbopenid' => $openId ]);

    $num = $memberSv->update($member['id'], ['subscribe' => 0]);

    if ($num) {
    
      $this->update($evtId, [ 'state' => 1, 'relat' => $member['wx_unionid'] ]);
    
    } else {
    
      $this->update($evtId, [ 'state' => -1, 'relat' => $member['wx_unionid'] ]);
    
    }
  
  }

}
