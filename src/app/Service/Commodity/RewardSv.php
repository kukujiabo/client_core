<?php
namespace App\Service\Commodity;

use App\Service\BaseService;
use Core\Service\CurdSv;
use App\Service\Resource\ImageSv;

/**
 * 赠品服务
 *
 * @author Meroc Chen <398515393@qq.com> 2018-06-03
 */
class RewardSv extends BaseService {

  use CurdSv;

  /**
   * 新增赠品
   *
   * @param array data
   *
   * @return int id
   */
  public function create($data) {

    $timeStr = date('Y-m-d H:i:s');

    $newReward = [

      'thumbnail' => $data['thumbnail'],
    
      'reward_name' => $data['reward_name'],

      'reward_code' => $data['reward_code'],

      'check_code' => $data['check_code'],

      'price' => $data['price'],

      'brief' => $data['brief'],

      'shop_id' => $data['shop_id'],

      'num' => $data['num'],

      'start_time' => $data['start_time'] ? date('Y-m-d H:i:s', $data['start_time']) : NULL,

      'end_time' => $data['end_time'] ? date('Y-m-d H:i:s', $data['end_time']) : NULL,

      'created_at' => $timeStr
    
    ];

    $imgs = json_decode($data['carousel'], true);

    if (!empty($imgs)) {
    
      $newReward['banner'] = $imgs[0]['url'];
    
    }
  
    $id = $this->add($newReward);

    if ($id) {
    
      $isv = new ImageSv();

      $rewardImages = [];

      $isv->batchCreate($imgs, 5, $id);
    
    }

    return $id;
  
  }

  /**
   * 更新赠品数据
   * @decs 更新赠品数据
   *
   * @param array data
   *
   * @return int num
   */
  public function edit($data) {

    $id = $data['id'];

    $updateData = [];

    if (isset($data['reward_name'])) {

      $updateData['reward_name'] = $data['reward_name'];
    
    }
    if (isset($data['reward_code'])) {

      $updateData['reward_code'] = $data['reward_code'];
    
    }
    if (isset($data['check_code'])) {

      $updateData['check_code'] = $data['check_code'];
    
    }
    if (isset($data['price'])) {

      $updateData['price'] = $data['price'];
    
    }
    if (isset($data['thumbnail'])) {

      $updateData['thumbnail'] = $data['thumbnail'];
    
    }
    if (isset($data['brief'])) {

      $updateData['brief'] = $data['brief'];
    
    }
    if (isset($data['thumbnail'])) {

      $updateData['shop_id'] = $data['shop_id'];
    
    }
    if (isset($data['status'])) {

      $updateData['status'] = $data['status'];
    
    }
    if (isset($data['start_time'])) {

      $updateData['start_time'] = $data['start_time'];
    
    }
    if (isset($data['end_time'])) {

      $updateData['end_time'] = $data['end_time'];
    
    }

    if ($data['carousel']) {
    
      $isv = new ImageSv();
    
      $carousel = json_decode($data['carousel'], true);

      $isv->batchDelete(5, $id);

      $isv->batchCreate($carousel, 5, $id);
    
    }
  
    return $this->update($id, $updateData);
  
  }


  /**
   * 查询列表
   * @desc 查询列表
   * 
   * @param array query
   */
  public function listQuery($data) {

    $query = array();
  
    if ($data['shop_id']) {
    
      $query['shop_id'] = $data['shop_id'];
    
    }
    if ($data['reward_code']) {
    
      $query['reward_code'] = $data['reward_code'];
    
    }
    if ($data['shop_name']) {
    
      $query['shop_name'] = $data['shop_name'];
    
    }
    if ($data['status']) {
    
      $query['status'] = $data['status'];
    
    }
  
    return $this->queryList($query, $data['fields'], $data['order'], $data['page'], $data['page_size']);
  
  }

  /**
   * 查询详情
   *
   * @param array data
   *
   * @return array data
   */
  public function getDetail($data) {

    $id = $data['id'];
  
    $reward = $this->findOne($id);

    if ($reward) {

      $isv = new ImageSv();
    
      $carousel =  $isv->all(array('relat_id' => $id, 'module' => 5));

      $reward['carousel'] = $carousel;
    
    } 

    return $reward;
  
  }

  /**
   * 商品门店联合信息查询
   *
   * @param data
   *
   * @return array data
   */
  public function rewardShopUnionList($data) {
  
    $query = [];

    if (isset($data['reward_name'])) {
    
      $query['reward_name'] = $data['reward_name'];
    
    }
    if (isset($data['shop_name'])) {
    
      $query['shop_name'] = $data['shop_name'];
    
    }
    if (isset($data['shop_id'])) {
    
      $query['shop_id'] = $data['shop_id'];
    
    }

    $vrs = new VRewardShopSv();

    return $vrs->queryList($query, $data['fields'], $data['order'], $data['page'], $data['page_size']);
  
  }

}
