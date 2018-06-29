<?php
namespace App\Service\Commodity;

use App\Service\BaseService;
use Core\Service\CurdSv;

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
