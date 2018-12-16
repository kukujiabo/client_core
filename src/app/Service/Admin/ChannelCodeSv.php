<?php
namespace App\Service\Admin;

use App\Service\BaseService;
use Core\Service\CurdSv;

class ChannelCodeSv extends BaseService {

  use CurdSv;

  public function create($data) {
  
    $newData = [
    
      'channel_id' => $data['channel_id'],

      'channel_code' => $data['channel_code'],

      'price' => $data['price'],

      'bank_id' => $data['bank_id'],

      'created_at' => date('Y-m-d H:i:s')
    
    ];
  
    return $this->add($newData);
  
  }

  public function getList($data) {
  
    $query = [];

    if ($data['channel_id']) {
    
      $query['channel_id'] = $data['channel_id'];
    
    }

    if ($data['bank_id']) {
    
      $query['bank_id'] = $data['bank_id'];
    
    }
  
    return $this->queryList($query, $data['fields'], $data['order'], $data['page'], $data['page_size']);
  
  }

}
