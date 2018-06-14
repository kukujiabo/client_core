<?php
namespace App\Domain;

use App\Service\Merchant\MerchantSv;

/**
 * 商户处理域
 *
 * @author Meroc Chen <398515393@qq.com>
 */
class MerchantDm {

  protected $_msv;

  public function __construct() {
  
    $this->_msv = new MerchantSv(); 
  
  }

  /**
   * 添加商户
   */
  public function addMerchant($data) {
  
    return $this->_msv->addMerchant($data);
  
  }

  /**
   * 更新商户
   */
  public function updateMerchant($id, $data) {
  
    return $this->_msv->updateMerchant($id, $data);
  
  }

  /**
   * 查询商户列表
   */
  public function listQuery($data) {

    $page = $data['page'];

    $pageSize = $data['page_size'];

    $order = $data['order'];

    $query = [];

    if ($data['mcode']) {

      $query['mcode'] = $data['mcode'];

    }
    if ($data['mname']) {

      $query['mname'] = $data['mname'];

    }
    if ($data['status']) {

      $query['status'] = $data['status'];

    }
  
    return $this->_msv->listQuery($query, '*', $order, $page, $pageSize); 
  
  }

  /**
   * 查询全部商户啊
   */
  public function getAll($data) {

    $order = $data['order'];

    $fields = $data['fields'];

    $query = [];

    if ($data['mcode']) {

      $query['mcode'] = $data['mcode'];

    }
    if ($data['mname']) {

      $query['mname'] = $data['mname'];

    }
    if ($data['status']) {

      $query['status'] = $data['status'];

    }

    return $this->_msv->getAll($query, $order, $fields);
  
  }

  /**
   * 查询详情接口
   */
  public function getDetail($params) {
  
    return $this->_msv->getDetail($params['id']);
  
  }

}
