<?php
namespace App\Service\Crm;

use App\Service\BaseService;
use Core\Service\CurdSv;

/**
 * 提现服务
 *
 * @author Meroc Chen <398515393@qq.com>
 */
class WithdrawSv extends BaseService {

  use CurdSv;

  public function create($data) {

    $mSv = new MemberSv();

    $member = $mSv->findOne($data['member_id']);

    if (!$member) {
    
      return 0;
    
    }

    $sequence = time() . rand(1000, 9999) . $member['member_identity'];
  
    $newWithdraw = [

      'sequence' => $sequence,
    
      'member_id' => $data['member_id'],

      'money' => $data['money'],

      'state' => 0,

      'created_at' => date('Y-m-d H:i:s')
    
    ];

    return $this->add($newWithdraw);
  
  }


}
