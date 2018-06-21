<?php
namespace App\Domain;

use App\Service\Crm\MemberSv;
use App\Service\Crm\MobileVerifyCodeSv;
use App\Service\Message\SmsSv;
use App\Service\Resource\ImageSv;

/**
 * 会员
 *
 * @author Meroc Chen <398515393@qq.com> 2018-01-30
 */
class MemberDm {

  protected $_memberSv;

  public function __construct() {
  
    $this->_memberSv = new MemberSv();

    $this->_mbv = new MobileVerifyCodeSv();
  
  }

  /**
   * 会员注册
   *
   * @param string $mobile
   * @param string $memberName
   *
   * @return int $id
   */
  public function register($mobile, $memberName, $password, $token = null) {
  
    /**
     * 返回注册结果
     */
    $id = $this->_memberSv->register($mobile, $password, $token);

    if ($id) {

      $extData = array(
      
        'member_name' => $memberName,

        'member_identity' => \App\getRandomDigit(12)
      
      );
    
      $urs = $this->_memberSv->update($id, $extData);
    
    }

    return $id;

  }

  /**
   * 查询会员列表
   *
   */
  public function listQuery($params) {
  
    return $this->_memberSv->listQuery($params);
  
  }


  /**
   * 通过短信验证码登录
   *
   * @param string $mobile
   * @param string $code
   *
   * @return array $memberInfo
   */
  public function loginViaCode($mobile, $code) {
  
    /**
     * 校验验证码，失败会抛出异常
     */
    $this->_mbv->checkVerifyCode($mobile, $code);
    
    return $this->_memberSv->loginViaAccount($mobile);
  
  }

  /**
   * 账号密码登录
   *
   * @param string $mobile
   * @param string $password
   *
   * @return array $memberInfo
   */
  public function loginViaPassword($mobile, $password) {
  
    return $this->_memberSv->loginViaPassword($mobile, $password);
  
  }

  /**
   * 编辑用户信息
   *
   * @param array $params
   *
   * @return mixed 
   */
  public function editMember($params) {

    $id = $params['id'];

    $data = array();

    if (isset($params['member_name'])) {

      $data['member_name'] = $params['member_name'];
    
    }

    if (isset($params['member_identity'])) {

      $data['member_identity'] = $params['member_identity'];
    
    }

    if (isset($params['wx_city'])) {

      $data['wx_city'] = $params['wx_city'];
    
    }
    if (isset($params['wx_province'])) {

      $data['wx_province'] = $params['wx_province'];
    
    }
    if (isset($params['portrait'])) {

      $data['portrait'] = $params['portrait'];
    
    }
    if (isset($params['sex'])) {

      $data['sex'] = $params['sex'];
    
    }

    if (!empty($data)) {
  
      return $this->_memberSv->editMember($id, $data);

    } else {

      return false;

    }
  
  }


  /**
   * 修改用户密码
   *
   * @param array $params
   *
   * @return mixed 
   */
  public function updatePassword($memberId, $oldPassword, $newPassword) {
  
    return $this->_memberSv->updatePassword($memberId, $oldPassword, $newPassword);
  
  }

  /**
   * 查看账号是否存在
   *
   * @param string $account
   *
   * @return
   */
  public function existAccount($account) {
  
    return $this->_memberSv->existAccount($account);
  
  }

  /**
   * 微信小程序登录
   */
  public function wechatMiniLogin($appName, $code, $shareCode, $memberName, $portrait, $gender) {
  
    return $this->_memberSv->wechatMiniLogin($appName, $code, $shareCode, $memberName, $portrait, $gender);
  
  }

  /**
   * 微信公众号登陆
   */
  public function wechatPubLogin($params) {
  
    return $this->_memberSv->wechatPubLogin($params['code'], $params['reference']);
  
  }

  /**
   * 获取用户二维码
   */
  public function getMemberQrCode($data) {

    $member = $this->_memberSv->findOne($data['member_id']);

    if (strpos($data['url'], '?') > 0) {

      $content = $data['url'] . "&reference={$member['reference']}";
    
    } else {

      $content = $data['url'] . "?reference={$member['reference']}";

    }
  
    $imgSv = new ImageSv();
  
    return $imgSv->createQrCode($content, true);
  
  }

}
