<?php
namespace App\Service\Commodity;

use App\Service\BaseService;
use Core\Service\CurdSv;

class YPosSv extends BaseService {

  use CurdSv;

  public function create($data) {
  
    $newApply = [
    
      'name' => $data['name'],
      'phone' => $data['phone'],
      'address' => $data['address'],
      'member_id' => $data['member_id'],
      'created_at' => date('Y-m-d H:i:s')
    
    ];

    return $this->add($newApply);
  
  }

  public function getList($data) {
  
    $query = []; 

    if ($data['name']) {
    
      $query['name'] = $data['name'];
    
    }
    if ($data['phone']) {
    
      $query['phone'] = $data['phone'];
    
    }

    return $this->queryList($query, $data['fields'], $data['order'], $data['page'], $data['page_size']);
  
  }

}
