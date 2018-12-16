<?php
namespace App\Domain;

use App\Service\Admin\AdminSv;

/**
 * 管理员处理域
 *
 * @author Meroc Chen <398515393@qq.com> 2018-03-02
 */
class AdminDm {

  protected $_asv;

  public function __construct() {
  
    $this->_asv = new AdminSv();
  
  }

  /**
   * 管理员登录
   */
  public function login($params) {
  
    return $this->_asv->login($params['account'], $params['password']);
  
  }

  /**
   * 获取当前会话管理员信息
   */
  public function sessionAdminInfo($params) {

    $id = $params['id'];
  
    $info = $this->_asv->findOne($id);

    if (empty($info)) {
    
      return NULL;
    
    } else {
    
      $adminInfo = [
      
        'id' => $info['id'],

        'name' => $info['account'],

        'avatar' => $info['avatar'],

        'roles' => [ $info['admin_name'] ]
      
      ];

      return $adminInfo;
    
    }
  
  }

  /**
   * 删除专辑
   *
   * @param int id
   *
   * @return int num
   */
  public function remove($id) {
  
    return $this->_asv->remove($id);
  
  }

  public function getAllChannel($data) {
  
    return $this->_asv->getAllChannel($data); 

  }

  public function addAcct($data) {
  
    return $this->_asv->addAcct($data); 
  
  }

  public function getChannelList($data) {
  
    return $this->_asv->getChannelList($data);
  
  }

}
