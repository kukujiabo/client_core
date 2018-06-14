<?php
namespace App\Service\Merchant;

use App\Service\BaseService;
use Core\Service\CurdSv;

/**
 * 会员关注店铺
 *
 * @author Meroc Chen <398515393@qq.com>
 */
class MemberFavoriteShopSv extends BaseService {

  use CurdSv;

  /**
   * 新建关注
   *
   * @param array data
   *
   * @return int id
   */
  public function create($data) {
  
    $newFocus = [
    
      'member_id' => $data['member_id'],
      'shop_id' => $data['shop_id'],
      'focus' => 1,
      'created_at' => date('Y-m-d H:i:s')
    
    ];

    return $this->add($newFocus);
  
  }

  /**
   * 取消关注
   *
   * @param array data
   *
   * @return int num
   */
  public function cancelFocus($data) {

    $cancelData = [
    
      'focus' => 0,
      'cancel_at' => date('Y-m-d H:i:s')
    
    ];
  
    return $this->update($data['id'], $cancelData);
  
  }

  /**
   * 查询是否关注
   *
   * @param int memberId
   * @param int shopId
   *
   * @return array object
   */
  public function getFocus($memberId, $shopId) {

    $query = [
    
      'member_id' => $memberId,
      'shop_id' => $shopId,
      'focus' => 1
    
    ];
  
    return $this->findOne($query);
  
  }

  /**
   * 查询联合关注信息
   *
   * @param array data
   *
   * @return array list
   */
  public function getUnionInfoList($data) {
  
    $query = [];

    if (isset($data['member_id'])) {
    
      $query['member_id'] = $data['member_id'];
    
    }
    if (isset($data['shop_id'])) {
    
      $query['shop_id'] = $data['shop_id'];
    
    }
    if (isset($data['focus'])) {
    
      $query['focus'] = $data['focus'];
    
    }
  
    $mfsSv = new VMemberFocusShopSv();

    return $mfsSv->queryList($query, $data['fields'], $data['order'], $data['page'], $data['page_size']);
  
  }


  /** 查询关注数量
   *
   * @param array data
   *
   * @return int num
   */
  public function getFocusCount($data) {
  
    $query = [];

    if (isset($data['member_id'])) {
    
      $query['member_id'] = $data['member_id'];
    
    }
    if (isset($data['shop_id'])) {
    
      $query['shop_id'] = $data['shop_id'];
    
    }
    if (isset($data['focus'])) {
    
      $query['focus'] = $data['focus'];
    
    }
  
    $mfsSv = new VMemberFocusShopSv();
  
    return $mfsSv->queryCount($query);

  }

}
