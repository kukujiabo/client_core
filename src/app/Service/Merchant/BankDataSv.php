<?php
namespace App\Service\Merchant;

use App\Service\BaseService;
use Core\Service\CurdSv;

/**
 * 银行数据
 *
 */
class BankDataSv extends BaseService {

  use CurdSv;

  public function reconciliation($data) {

    $meSv = new MerchantSv();

    $bank =$meSv->findOne($data['bank_id']);

    $fileName = $bank['mcode'] . time();

    if (!copy($data["file_path"], API_ROOT . "/public/uploads/" . $fileName )) {
    
      return 0;
    
    } else {

      $sequence = time() . rand(1000, 9999);
    
      $newFile = [
      
        'bank_id' => $data['bank_id'],

        'sequence' => $sequence,

        'orig_name' => $data['orig_name'],

        'state' => 0,

        'file_name' => $fileName,

        'file_path' => API_ROOT . "/public/uploads/{$fileName}",

        'created_at' => date('Y-m-d H:i:s')
      
      ];
    
      return $this->add($newFile);
    
    }

  }

  /**
   * 查询上传文件列表
   *
   */
  public function getList($data) {
  
    $fileSv = new VBankFileSv();
  
    $query = [];

    if ($data['mname']) {
    
      $query['mname'] = $data['mname'];
    
    }
    if ($data['orig_name']) {
    
      $query['orig_name'] = $data['orig_name'];
    
    }

    return $fileSv->queryList($query, $data['fields'], $data['order'], $data['page'], $data['page_size']);
  
  }

}
