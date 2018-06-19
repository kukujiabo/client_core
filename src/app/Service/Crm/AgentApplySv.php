<?php
namespace App\Service\Crm;

use App\Service\BaseService;
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
    
      return $vaamSv->findOne($params['member_id']);
    
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
