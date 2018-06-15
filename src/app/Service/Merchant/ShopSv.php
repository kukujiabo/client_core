<?php namespace App\Service\Merchant;

use App\Service\BaseService;
use Core\Service\CurdSv;
use App\Service\Resource\ImageSv;
use App\Service\Components\Map\TXMapSv;

/**
 * 门店服务类
 *
 * @author Meroc Chen <398515393@qq.com> 2018-04-29
 */
class ShopSv extends BaseService {

  use CurdSv;

  /**
   * 添加门店
   *
   * @param array data
   *
   * @return int id
   */
  public function create($data) {
  
    /**
     * 新增门店数据
     */
    $newData = [
      'mid' => $data['mid'],
      'shop_code' => $data['shop_code'],
      'shop_name' => $data['shop_name'],
      'phone' => $data['phone'],
      'open_time' => $data['open_time'],
      'thumbnail' => $data['thumbnail'],
      'words' => $data['words'],
      'ext_1' => $data['ext_1'],
      'ext_2' => $data['ext_2'],
      'brief' => $data['brief'],
      'image_text' => $data['image_text'],
      'shop_address' => $data['shop_address'],
      'status' => $data['status'],
      'created_at' => date('Y-m-d H:i:s')
    ];

    $map = new TXMapSv();

    $titude = $map->getQqAddress($data['shop_address']);

    if($titude) {

      $newData['longtitude'] = $titude['result']['location']['lng'];
      $newData['latitude'] = $titude['result']['location']['lat'];
    
    }

    $shopId = $this->add($newData);

    /**
     * 新增门店轮播图
     */
    $carousel = json_decode($data['carousel'], true);

    if (!empty($carousel)) {
    
      $imgSv = new ImageSv();

      $imgSv->batchCreate($carousel, 4, $shopId);
    
    }

    return $shopId;
  
  }

  /**
   * 更新门店
   *
   * @param int id
   * @param array data
   *
   * @return int num
   */
  public function updateShop($id, $data) {
  
    $updateData = [];

    if (isset($data['mid'])) {
    
      $updateData['mid'] = $data['mid'];
    
    }
    if (isset($data['thumbnail'])) {
    
      $updateData['thumbnail'] = $data['thumbnail'];
    
    }
    if (isset($data['shop_code'])) {
    
      $updateData['shop_code'] = $data['shop_code'];
    
    }
    if (isset($data['shop_name'])) {
    
      $updateData['shop_name'] = $data['shop_name'];
    
    }
    if (isset($data['open_time'])) {
    
      $updateData['open_time'] = $data['open_time'];
    
    }
    if (isset($data['phone'])) {
    
      $updateData['phone'] = $data['phone'];
    
    }
    if (isset($data['brief'])) {
    
      $updateData['brief'] = $data['brief'];
    
    }
    if (isset($data['image_text'])) {
    
      $updateData['image_text'] = $data['image_text'];
    
    }
    if (isset($data['shop_address'])) {
    
      $updateData['shop_address'] = $data['shop_address'];
    
    }
    if (isset($data['status'])) {
    
      $updateData['status'] = $data['status'];
    
    }

    if ($data['carousel']) {

      $isv = new ImageSv();
    
      $carousel = json_decode($data['carousel'], true);

      $isv->batchDelete(4, $id);

      $isv->batchCreate($carousel, 4, $id);
    
    }

    if (!empty($updateData)) {

      $this->update($id, $updateData);

    }

    return true;

  }

  /**
   * 查询门店列表
   *
   * @param array query
   * @param string fields
   * @param string order
   * @param int page
   * @param int pageSize
   *
   * @return array list
   */
  public function listQuery($query, $fields = '*', $order = 'id desc', $page = 1, $pageSize = 20) {
  
    return $this->queryList($query, $fields, $order, $page, $pageSize);
  
  }

  /**
   * 查询门店详情
   *
   * @param int id
   *
   * @return array data
   */
  public function getDetail($id) {

    $shop = $this->findOne($id);

    $isv = new ImageSv();

    if (!$shop) {
    
      return $shop;
    
    }

    /**
     * 门店轮播，module = 4
     */
    $images = $isv->all(array('relat_id' => $id, 'module' => 4));
  
    $shop['carousel'] = $images;

    return $shop;

  }

  /**
   * 查询门店全部列表
   *
   * @param array data
   *
   * @return array list
   */
  public function getAll($data) {

    $query = [];
  
    if (isset($data['shop_name'])) {
    
      $query['shop_name'] = $data['shop_name'];
    
    }
    if (isset($data['shop_code'])) {
    
      $query['shop_code'] = $data['shop_code'];
    
    }
    if (isset($data['status'])) {
    
      $query['status'] = $data['status'];
    
    }
    if (isset($data['mid'])) {
    
      $query['mid'] = $data['mid'];
    
    }

    return $this->all($query, $data['order'], $data['fields']);
  
  }

}
