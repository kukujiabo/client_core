<?php
namespace App\Api;

/**
 * 管理员接口
 *
 * @author Meroc Chen <398515393@qq.com> 2018-03-02
 */
class Admin extends BaseApi {

  public function getRules() {
  
    return $this->rules([
    
      'login' => [
      
        'account' => 'account|string|true||账号',

        'password' => 'password|string|true||密码'
      
      ],

      'addAcct' => [
      
        'account' => 'account|string|true||账号',

        'password' => 'password|string|true||密码'
      
      ],

      'sessionAdminInfo' => [

        'id' => 'id|int|true||管理员id'
      
      ],

      'getAllChannel' => [


      ],

      'remove' => [
      
        'id' => 'id|int|true||管理员id'
      
      ],

      'getChannelList' => [

        'keywords' => 'keywords|string|false||关键字',

        'page' => 'page|int|false|1|页码',

        'page_size' => 'page_size|int|false||每页条数'
      
      ]
    
    ]);
  
  }

  /**
   * 管理员登录
   * @desc 管理员登录
   *
   * @return token
   */
  public function login() {

    return $this->dm->login($this->retriveRuleParams(__FUNCTION__));
  
  }

  /**
   * 当前会话管理员信息
   * @desc 当前会话管理员信息
   *
   * @return array info
   */
  public function sessionAdminInfo() {
  
    return $this->dm->sessionAdminInfo($this->retriveRuleParams(__FUNCTION__)); 

  }

  /**
   * 查询所有渠道商
   * @desc 查询所有渠道商
   *
   * @return array info
   */
  public function getAllChannel() {
  
    return $this->dm->getAllChannel($this->retriveRuleParams(__FUNCTION__)); 
  
  }

  /**
   * 新增渠道
   * @desc 新增渠道
   *
   * @return int id
   */
  public function addAcct() {
  
    return $this->dm->addAcct($this->retriveRuleParams(__FUNCTION__)); 
  
  }

  /**
   * 查询渠道列表
   * @desc 查询渠道列表
   *
   * @return array list
   */
  public function getChannelList() {
  
    return $this->dm->getChannelList($this->retriveRuleParams(__FUNCTION__)); 
  
  }

  /**
   * 删除渠道
   * @desc 删除渠道
   *
   * @return int num
   */
  public function remove() {
  
    return $this->dm->remove($this->retriveRuleParams(__FUNCTION__)); 
  
  }

}
