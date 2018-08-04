<?php
namespace App\Service\Commodity;

use App\Service\BaseService;
use Core\Service\CurdSv;

/**
 * pos机返佣页面
 *
 *
 */
class PosMechineSv extends BaseService {

  use CurdSv;

  public function create($data) {
  
    $newPos = [
    
      'pos_name' => $data['pos_name'],
      'price' => $data['price'],
      'brief' => $data['brief'],
      'pos_img' => $data['pos_img'],
      'created_at' => date('Y-m-d H:i:s')
    
    ];
  
    return $this->add($newPos);
  
  }

  public function getList($data) {
  
    $query = [];

    if ($data['pos_name']) {
    
      $query['pos_name'] = $data['pos_name'];
    
    }

    return $this->queryList($query, $data['fields'], $data['order'], $data['page'], $data['page_size']);
  
  }


}
