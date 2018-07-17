<?php
namespace App\Service\Components\Alipay;

use App\Service\BaseService;
use Core\Service\CurdSv;

class AlipayBatchPayLogSv extends BaseService {

  use CurdSv;

  public function addLogData($data) {
  
    $data['created_at'] = date('Y-m-d H:i:s');
  
    return $this->add($data);
  
  }

}
