<?php
namespace App\Service\Commodity;

use App\Service\BaseService;
use Core\Service\CurdSv;
use PhpOffice\PhpSpreadSheet\SpreadSheet;
use PhpOffice\PhpSpreadSheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;
use App\Exception\LogException;

/**
 * 贷款对账数据
 *
 */
class LoanDataSv extends BaseService {

  use CurdSv;

  /**
   * 上传数据
   *
   */
  public function reconciliation($data) {

    $rdSv = new RewardSv();

    $loan = $rdSv->findOne($data['loan_id']);

    $exist = $this->findOne([ 'orig_name' => $data['orig_name'] ]);

    if ($exist) {
    
      throw new LogException($this->_err->DUPLICATEBKFILEMSG, $this->_err->DUPLICATEBKFILECODE);
    
    }

    $fileName = $loan['reward_code'] . time();

    if (!copy($data["file_path"], API_ROOT . "/public/uploads/loans/" . $fileName )) {
    
      throw new LogException($this->_err->FILETRANSFERFAILEDMSG , $this->_err->FILETRANSFERFAILEDCODE);
    
    } else {

      $sequence = time() . rand(1000, 9999);
    
      $newFile = [
      
        'loan_id' => $data['loan_id'],

        'sequence' => $sequence,

        'orig_name' => $data['orig_name'],

        'state' => 0,

        'file_name' => $fileName,

        'file_path' => API_ROOT . "/public/uploads/loans/{$fileName}",

        'created_at' => date('Y-m-d H:i:s')
      
      ];
    
      return $this->add($newFile);
    
    }

  }

  /**
   * 导入数据
   * @desc 导入数据
   *
   * @return array
   */
  public function importData($data) {
  
    $fileInfo = $this->findOne($data['id']);

    $acSv = new AuditLoanSv();

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
        'money' => $row[5],
        'product_name' => $row[6],
        'source' => $row[7],
        'created_at' => date('Y-m-d H:i:s'),
        'loan_id' => $fileInfo['loan_id'],
        'sequence' => $fileInfo['sequence'],
        'counted' => 0,
        'write_off' => 0,

      ];
    
      array_push($dataset, $newData);
    
    }

    $acSv = new AuditLoanSv();

    $num = $acSv->batchAdd($dataset);

    if ($num) {

      $this->update($fileInfo['id'], [ 'state' => 1 ]);

      return $num;

    } else {
    
      return 0;
    
    }

  }

  /**
   * 查询文件列表
   * @desc 查询文件列表
   *
   * @return
   */
  public function getList($data) {
  
    $fileSv = new VLoanFileSv();
  
    $query = [];

    if ($data['reward_name']) {
    
      $query['reward_name'] = $data['reward_name'];
    
    }
    if ($data['orig_name']) {
    
      $query['orig_name'] = $data['orig_name'];
    
    }

    return $fileSv->queryList($query, $data['fields'], $data['order'], $data['page'], $data['page_size']);
  
  }
  
}
