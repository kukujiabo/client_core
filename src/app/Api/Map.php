<?php
namespace App\Api;

/**
 * 地图接口
 *
 */
class Map extends BaseApi {

  public function getRules() {
  
    return $this->rules([
    
      'getAddress' => [
      
        'address' => 'address|string|true||地址'
      
      ]

    
    ]);
  
  }

  /**
   * 查询地址经纬度
   * @desc 查询地址经纬度
   *
   */
  public function getAddress() {
  
    return $this->dm->getAddress($this->retriveRuleParams(__FUNCTION__));
  
  }

}
