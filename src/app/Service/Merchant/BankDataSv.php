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

    if (move_uploaded_file($data["file_path"], API_ROOT . "/public/uploads/" . $fileName )) {
    
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

}
