<?php
namespace App\Service\Merchant;

use App\Service\BaseService;
use Core\Service\CurdSv;
use PhpOffice\PhpSpreadSheet\SpreadSheet;
use PhpOffice\PhpSpreadSheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

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

  /**
   * 导入数据
   * @desc 导入数据
   *
   * @return array
   */
  public function importData($data) {
  
    $fileInfo = $this->findOne($data['id']);

    $acSv = new AuditCardSv();

    $spreadSheet = IOFactory::load($fileInfo['file_path']);

    $sheetData = $spreadSheet->getActiveSheet()->toArray(null, true, true, false);
  
    $dataset = [];

    foreach($sheetData as $row) {
    
      $newData = [
      
        'name' => $row[0],
        'phone' => $row[1],
        'state' => $row[2],
        'in_date' => $row[3],
        'audit_date' => $row[4],
        'source' => $row[5],
        'created_at' => date('Y-m-d H:i:s'),
        'counted' => 0,
        'bank_id' => $fileInfo['bank_id'],
        'sequence' => $fileInfo['sequence']

      ];
    
      array_push($dataset, $newData);
    
    }

    $acSv = new AuditCardSv();

    $num = $acSv->batchAdd($dataset);

    if ($num) {

      $this->update($fileInfo['id'], [ 'state' => 1 ]);

      return $num;

    } else {
    
      return 0;
    
    }

  }



  /**
   * 比对数据
   *
   * @param array applyData
   * @param array auditData
   *
   * @return boolean 
   */
  public function matchData($applyData, $auditData) {
  
    $apname = $applyData['name'];

    $auname = $auditData['name'];
  
    $apphone = $applyData['phone'];

    $auphone = $auditData['phone'];

    $matchedPhone1 = substr($apphone, 0, 3) . substr($apphone, 8, 3);

    $matchedPhone2 = substr($auphone, 0, 3) . substr($auphone, 8, 3);

    if (strpos($auname, '*') === 0) {
    
      $matched1 = mb_substr($apname, mb_strlen($apname) - 1, 1, 'utf-8');

      $matched2 = mb_substr($auname, mb_strlen($auname) - 1, 1, 'utf-8');

      return $matched1 == $matched2 && $matchedPhone1 == $matchedPhone2;
    
    } elseif (strpos($auname, '*') > 0) {

      $matched1 = mb_substr($apname, 0, 1, 'utf-8');

      $matched2 = mb_substr($auname, 0, 1, 'utf-8');

      return $matched1 == $matched2 && $matchedPhone1 == $matchedPhone2;
    
    } elseif (strpos($auname, '*') === false) {
    
      return $apname == $auname && $matchedPhone1 == $matchedPhone2;
    
    }
  
  }

}
