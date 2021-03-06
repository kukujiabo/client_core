<?php
namespace App\Service\Crm;

use App\Service\BaseService;
use App\Service\Account\AccountSv;
use Core\Service\CurdSv;

/**
 * 合伙人申请
 *
 * @author Meroc Chen <398515393@qq.com> 
 */
class AgentApplySv extends BaseService {

  use CurdSv;

  /**
   * 新建代理商申请
   *
   */
  public function create($params) {
  
    $newApply = [
    
      'member_id' => $params['member_id'],
      'name' => $params['name'],
      'phone' => $params['phone'],
      'identity' => $params['identity'],
      'city' => $params['city'],
      'state' => 0,
      'created_at' => date('Y-m-d H:i:s')
    
    ];

    return $this->add($newApply);
  
  }

  /**
   * 同意申请
   *
   */
  public function accept($data) {
  
    $res = $this->update($data['id'], [ 'state' => 1, 'confirm_at' => date('Y-m-d H:i:s') ]);
  
    if ($res) {
    
      $apply = $this->findOne($data['id']);
    
      $mSv = new MemberSv();

      /**
       * 更新用户等级
       */
      $mSv->update($apply['member_id'], [ 'member_type' => 3 ]);

    }

    return $res;
  
  }

  /**
   * 编辑代理商
   *
   */
  public function edit($id, $data) {
  
    return $this->update($id, $data); 
  
  }

  /**
   * 代理商申请详情
   *
   */
  public function getDetail($params) {

    $vaamSv = new VAgentApplyMemberSv();

    if ($params['id']) {
    
      return $vaamSv->findOne($params['id']);
    
    } elseif ($params['member_id']) {
    
      return $vaamSv->findOne([ 'member_id' => $params['member_id']]);
    
    } else {
    
      return null;
    
    }
  
  }

  /**
   * 查询列表
   *
   */
  public function getList($params) {

    $query = [];

    if (isset($params['name'])) {
    
      $query['name'] = $params['name'];
    
    }
    if (isset($params['phone'])) {
    
      $query['phone'] = $params['phone'];
    
    }
    if (isset($params['city'])) {
    
      $query['city'] = $params['city'];
    
    }
  
    $vaamSv = new VAgentApplyMemberSv();

    return $vaamSv->queryList($query, $params['fields'], $params['order'], $params['page'], $params['page_size']);
  
  }

}
