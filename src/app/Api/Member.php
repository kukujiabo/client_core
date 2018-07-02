<?php
namespace App\Api;

/**
 * 会员接口
 *
 * @author Meroc Chen <398515393@qq.com> 2018-01-30
 */
class Member extends BaseApi {

  public function getRules() {
  
    return $this->rules([
    
      'register' => [
      
        'mobile' => 'mobile|string|true||会员手机号',

        'member_name' => 'member_name|string|true||会员名称',

        'password' => 'password|string|true||会员密码',

        'token' => 'token|string|false||sessionid',
      
      ],

      'listQuery' => [
      
        'member_name' => 'member_name|string|false||会员名称',
        'sex' => 'sex|string|false||会员性别',
        'reference' => 'reference|string|false||上级推荐人',
        'order' => 'order|string|false||排序',
        'fields' => 'fields|string|false||查询字段',
        'page' => 'page|int|false||页码',
        'page_size' => 'page_size|int|false||每页条数'
      
      ],

      'loginViaCode' => [
      
        'mobile' => 'mobile|string|true||会员手机号',

        'code' => 'code|string|true||验证码'
      
      ],

      'loginViaPassword' => [
      
        'mobile' => 'mobile|string|true||会员手机号',

        'password' => 'password|string|true||验证码'
      
      ],

      'editMember' => [
      
        'id' => 'id|int|true||用户表序号',

        'member_name' => 'member_name|string|false||用户昵称',

        'wx_city' => 'wx_city|string|false||用户城市',

        'wx_province' => 'wx_province|string|false||用户省份',

        'portrait' => 'portrait|string|false||用户头像',
      
        'member_identity' => 'member_identity|string|false||用户 ID',

        'sex' => 'sex|int|false||性别'
      
      ],

      'resetPassword' => [

        'mobile' => 'mobile|string|true||手机号',
  
        'new_password' => 'new_password|string|true||新密码',

        'code' => 'code|string|true||验证码'
  
      ],

      'updatePassword' => [

        'member_id' => 'member_id|int|false||用户id',
      
        'old_password' => 'old_password|string|false||旧密码',

        'new_password' => 'new_password|string|true||新密码',
      
      ],

      'existAccount' => [
      
        'account' => 'account|string|true||账号'
      
      ],

      'wechatMiniLogin' => [

        'app_name' => 'app_name|string|true||微信应用名称',
      
        'code' => 'code|string|true||微信code',

        'share_code' => 'share_code|string|false||分享编号',

        'member_name' => 'member_name|string|false||昵称',

        'portrait' => 'portrait|string|false||头像',

        'gender' => 'gender|int|false||性别'
      
      ],

      'wechatPubLogin' => [
      
        'code' => 'code|string|true||微信code',

        'reference' => 'reference|string|false||推荐人'
      
      ],

      'getMemberQrCode' => [
      
        'member_id' => 'member_id|int|true||会员id',

        'url' => 'url|string|true||办理链接'
      
      ],

      'getReferenceList' => [
      
        'reference' => 'reference|string|true||推荐人',
        'page' => 'page|int|false|1|页码',
        'page_size' => 'page_size|int|false|8|每页条数'
      
      ],

      'checkPartner' => [
      
        'member_id' => 'member_id|int|true||会员id'
      
      ]
    
    ]);
  
  }

  /**
   * 用户注册接口
   * @desc 用户注册接口
   *
   * @param 
   * @param
   */
  public function register() {

    $params = $this->retriveRuleParams(__FUNCTION__);
  
    return $this->dm->register($params['mobile'], $params['member_name'], $params['password'], $params['token']);
  
  }

  /**
   * 查询会员列表
   * @desc 查询会员列表
   *
   * @return array list
   */
  public function listQuery() {
  
    return $this->dm->listQuery($this->retriveRuleParams(__FUNCTION__));
  
  }

  /**
   * 用户手机验证码登录
   * @desc 用户手机验证码登录
   *
   * @return int num
   */
  public function loginViaCode() {
  
    $params = $this->retriveRuleParams(__FUNCTION__);

    return $this->dm->loginViaCode($params['mobile'], $params['code']);
  
  }

  /**
   * 用户账号密码登录
   * @desc 用户账号密码登录接口
   *
   * @return int num
   */
  public function loginViaPassword() {
  
    $params = $this->retriveRuleParams(__FUNCTION__);

    return $this->dm->loginViaPassword($params['mobile'], $params['password']);
  
  }

  /**
   * 编辑用户信息
   * @desc 编辑用户信息
   *
   * @return int num
   */
  public function editMember() {
  
    $params = $this->retriveRuleParams(__FUNCTION__);
  
    return $this->dm->editMember($params);

  }

  /**
   * 会员修改手机号
   * @desc 会员修改手机号
   *
   * @return boolean true/false
   */
  public function updatePassword() {
  
    $params = $this->retriveRuleParams(__FUNCTION__);
  
    return $this->dm->updatePassword($params['member_id'], $params['old_password'], $params['new_password']);
  
  }

  /**
   * 检查账号是否存在
   * @desc 检查账号是否存在
   *
   * @return boolean true/false
   */
  public function existAccount() {
  
    $params = $this->retriveRuleParams(__FUNCTION__);
  
    return $this->dm->existAccount($params['account']);
  
  }

  /**
   * 微信小程序登录
   * @desc 微信小程序登录
   *
   * @return 
   */
  public function wechatMiniLogin() {
  
    $params = $this->retriveRuleParams(__FUNCTION__);

    return $this->dm->wechatMiniLogin($params['app_name'], $params['code'], $params['share_code'], $params['member_name'], $params['portrait'], $params['gender']);

  }

  /**
   * 微信公众号登陆
   * @desc 微信公众号登陆
   *
   * @return
   */
  public function wechatPubLogin() {
  
    return $this->dm->wechatPubLogin($this->retriveRuleParams(__FUNCTION__));
  
  }

  /**
   * 生成用户推广二维码
   * @decs 生成用户推广二维码
   *
   * @return string base64
   */
  public function getMemberQrCode() {
  
    return $this->dm->getMemberQrCode($this->retriveRuleParams(__FUNCTION__));  
  
  }

  /**
   * 查询下级合伙人列表:
   * @desc 查询下级合伙人列表:
   *
   * @return array list
   */
  public function getReferenceList() {
  
    return $this->dm->getReferenceList($this->retriveRuleParams(__FUNCTION__));
  
  }

  /**
   * 检查合伙人状态
   * @desc 检查合伙人状态
   *
   * @return 
   */
  public function checkPartner() {
  
    return $this->dm->checkPartner($this->retriveRuleParams(__FUNCTION__));
  
  }

  /**
   * 重制密码
   * @desc 重制密码
   *
   * @return
   */
  public function resetPassword() {
  
    return $this->dm->resetPassword($this->retriveRuleParams(__FUNCTION__));
  
  }


}
