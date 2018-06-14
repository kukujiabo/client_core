<?php
namespace App\Domain;

use App\Service\Commodity\RewardSv;
use App\Service\Commodity\VMemberRewardInsSv;

class RewardDm {

  protected $rwdSv;

  public function __construct() {
  
    $this->rwdSv = new RewardSv();
  
  }

  public function create($data) {
  
    return $this->rwdSv->create($data); 
  
  }

  public function edit($data) {
  
    return $this->rwdSv->edit($data);
  
  }

  public function getAll($data) {
  
    return $this->rwdSv->getAll($data);
  
  }

  public function listQuery($data) {
  
    return $this->rwdSv->listQuery($data);
  
  }

  public function getDetail($data) {
  
    $detail = $this->rwdSv->getDetail($data);

    if ($data['member_id']) {
    
      $vmrSv = new VMemberRewardInsSv();
    
      $detail['retrived'] = $vmrSv->findOne([ 'member_id' => $data['member_id'], 'reward_id' => $detail['id'] ]);
    
    }

    return $detail;

  }

  public function rewardShopUnionList($data) {
  
    $list = $this->rwdSv->rewardShopUnionList($data);

    if ($data['member_id']) {

      $listData = $list['list'];

      $vmrSv = new VMemberRewardInsSv();

      foreach($listData as $key => $reward) {

        $listData[$key]['retrived'] = $vmrSv->findOne([ 'member_id' => $data['member_id'], 'reward_id' => $reward['reward_id']]);
      
      }

      $list['list'] = $listData;
  
    }


    return $list;

  }

}
