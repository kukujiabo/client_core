<?php
namespace App\Domain;

use App\Service\Crm\MemberTurnoverSv;

class MemberTurnoverDm {

  protected $_mtsv;

  public function __construct() {
  
    $this->_mtsv = new MemberTurnoverSv();
  
  }

  public function getList($params) {
  
    return $this->_mtsv->getList($params);
  
  }

  public function applyCash($params) {
  
    $cash = $this->_mtsv->findOne($params['id']);

    if ($cash['member_id'] == $params['member_id']) {
    
      return $this->update($params['id'], [ 'type' => 2 ]);
    
    } else {

      return 0;
    
    }
  
  }

}
