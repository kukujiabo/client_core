<?php
namespace App\Service\Merchant;

use App\Service\BaseService;
use App\Service\Crm\MemberSv;
use Core\Service\CurdSv;
use App\Service\Crm\VBapplyMemberCardSv;
use App\Service\Crm\VBapplyMemberLoanSv;

/**
 * 商户入驻申请服务
 *
 */
class BusinessApplySv extends BaseService {

  use CurdSv;

  /**
   * 新增申请
   *
   * @param array data
   *
   * @return int id
   */
  public function create($data) {

    $msv = new MemberSv();

    $member = $msv->findOne($data['member_id']);

    $bankId = 0;

    if ($type == 'card') {

      $shop = new ShopSv();
    
      $card = $shop->findOne($data['relat_id']);

      $bankId = $card['mid'];
    
    }
  
    $newData = [
    
      'member_id' => $data['member_id'],
      'type' => $data['type'],
      'relat_id' => $data['relat_id'],
      'name' => $data['name'],
      'address' => $data['address'],
      'contact' => $data['contact'],
      'phone' => $data['phone'],
      'wechat' => $data['wechat'],
      'bank_id' => $data['bank_id'],
      'brief' => $data['brief'],
      'reference' => $member['reference'],
      'created_at' => date('Y-m-d H:i:s')
    
    ];

    return $this->add($newData); 
  
  }

  /**
   * 查询申请列表
   *
   * @param array data
   *
   * @return array list
   */
  public function listQuery($data) {

    $query = [];
  
    if (isset($data['name'])) {
    
      $query['name'] = $data['name'];
    
    }
    if (isset($data['contact'])) {
    
      $query['contact'] = $data['contact'];
    
    }
    if (isset($data['phone'])) {
    
      $query['phone'] = $data['phone'];
    
    }

    $vbaSv = new VBapplyMemberCardSv();

    return $vbaSv->queryList($query, $data['fields'], $data['order'], $data['page'], $data['page_size']);
  
  }

  /**
   * 查询信用卡申请
   *
   */
  public function getReferenceCards($data) {

    $cardSv = new VBapplyMemberCardSv();

    $query = [ 'reference' => $data['reference'] ];
  
    return $cardSv->queryList($query, '*', 'id desc', $data['page'], $data['page_size']);
  
  }

  /**
   * 查询贷款申请
   *
   */
  public function getReferenceLoans($data) {
  
    $loanSv = new VBapplyMemberLoanSv();
  
    $query = [ 'reference' => $data['reference'] ];

    return $loanSv->queryList($query, '*', 'id desc', $data['page'], $data['page_size']);

  }

}
