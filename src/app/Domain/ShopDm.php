<?php
namespace App\Domain;

use App\Service\Merchant\ShopSv;
use App\Service\Merchant\MemberFavoriteShopSv;

/**
 * 店铺处理域
 *
 * @author Meroc Chen <398515393@qq.com> 2018-04-29
 */
class ShopDm {

  protected $_spsv;

  public function __construct() {
  
    $this->_spsv = new ShopSv();
  
  }

  /**
   * 新增店铺
   */
  public function create($data) {
  
    return $this->_spsv->create($data);
  
  }

  /**
   * 更新店铺
   */
  public function updateShop($id, $data) {
  
    return $this->_spsv->updateShop($id, $data);
  
  }

  /**
   * 列表查询
   */
  public function listQuery($data) {

    $page = $data['page'];

    $pageSize = $data['page_size'];

    $order = $data['order'];

    $fields = $data['fields'];

    $query = [];

    if (isset($data['mid'])) {
    
      $query['mid'] = $data['mid'];
    
    }
    if (isset($data['shop_name'])) {
    
      $query['shop_name'] = $data['shop_name'];
    
    }
    if (isset($data['shop_code'])) {
    
      $query['shop_code'] = $data['shop_code'];
    
    }
    if (isset($data['status'])) {
    
      $query['status'] = $data['status'];
    
    }

    return $this->_spsv->listQuery($query, $fields, $order, $page, $pageSize);
  
  }

  /**
   * 查询门店详情
   */
  public function getDetail($data) {
  
    $shop = $this->_spsv->getDetail($data['id']);

    if ($data['member_id']) {

      $fSv = new MemberFavoriteShopSv();
    
      $shop['focus'] = $fSv->getFocus($data['member_id'], $shop['id']);
    
    }

    return $shop;
  
  }

  public function getAll($data) {
  
    return $this->_spsv->getAll($data); 

  }

  /**
   * 查询信用卡佣金列表
   *
   */
  public function getCardCommissionList($data) {
  
    return $this->_spsv->getCardCommissionList($data); 

  }

  /**
   * 商铺登录
   *
   */
  public function login($data) {
  
    return $this->_spsv->login($data);
  
  }

}
