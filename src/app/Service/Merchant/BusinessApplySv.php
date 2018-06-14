<?php
namespace App\Service\Merchant;

use App\Service\BaseService;
use Core\Service\CurdSv;

/**
 * 商户入驻申请服务
 *
 */
class BusinessApplySv extends BaseService {

  use CurdSv;

  /**
   * 新增申请
   *
   * @param array data
   *
   * @return int id
   */
  public function create($data) {
  
    $newData = [
    
      'member_id' => $data['member_id'],
      'name' => $data['name'],
      'address' => $data['address'],
      'contact' => $data['contact'],
      'phone' => $data['phone'],
      'wechat' => $data['wechat'],
      'brief' => $data['brief'],
      'created_at' => date('Y-m-d H:i:s')
    
    ];

    return $this->add($newData); 
  
  }

  /**
   * 查询申请列表
   *
   * @param array data
   *
   * @return array list
   */
  public function listQuery($data) {

    $query = [];
  
    if (isset($data['name'])) {
    
      $query['name'] = $data['name'];
    
    }
    if (isset($data['contact'])) {
    
      $query['contact'] = $data['contact'];
    
    }
    if (isset($data['phone'])) {
    
      $query['phone'] = $data['phone'];
    
    }

    return $this->queryList($query, $data['fields'], $data['order'], $data['page'], $data['page_size']);
  
  }


}
