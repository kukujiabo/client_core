<?php
namespace App\Domain;

use App\Service\Merchant\MemberFavoriteShopSv;

class MemberFavoriteShopDm {

  protected $_mfsSv;

  public function __construct() {
  
    $this->_mfsSv = new MemberFavoriteShopSv();
  
  }

  public function create($data) {
  
    return $this->_mfsSv->create($data);
  
  }

  public function cancelFocus($data) {
  
    return $this->_mfsSv->cancelFocus($data);
  
  }

  public function getUnionInfoList($data) {
  
    return $this->_mfsSv->getUnionInfoList($data);
  
  }

  public function getFocusCount($data) {
  
    return $this->_mfsSv->getFocusCount($data);
  
  }

}
