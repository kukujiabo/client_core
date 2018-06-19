<?php
namespace App\Service\Merchant;

use Core\Service\CurdSv;
use App\Service\BaseService;
use App\Service\Components\Qiniu\QiniuSv;
use App\Service\Components\Wechat\WechatAppSv;
use App\Service\Resource\ImageSv;

/**
 * 商家服务类
 *
 * @author Meroc Chen <398515393@qq.com> 2018-04-28
 */
class MerchantSv extends BaseService {

  use CurdSv;

  protected $_qsv;

  public function __construct() {
  

  }

  /**
   * 获取店铺微信小程序码
   *
   * @param
   *
   * @return
   */
  public function getMerchantTempCode($mid = null) {
  
    $wappsv = new WechatAppSv();

    $qsv = new QiniuSv();

    $imageBytes = $wappsv->getMiniTempCode(1, 'pages/index/index', 400, false, null);

    return $qsv->uploadByteImage($imageBytes);
  
  }

  /**
   * 添加商户
   *
   * @param array data
   *
   * @return int id
   */
  public function addMerchant($data) {

    //todo transaction
  
    /**
     * 新增商家数据
     */
    $newData = [
      'mcode' => $data['mcode'],
      'mname' => $data['mname'],
      'phone' => $data['phone'],
      'brief' => $data['brief'],
      'process_url' => $data['process_url'],
      'image_text' => $data['image_text'],
      'thumbnail' => $data['thumbnail'],
      'ext_1' => $data['ext_1'],
      'ext_2' => $data['ext_2'],
      'status' => $data['status'],
      'created_at' => date('Y-m-d H:i:s')
    ];

    $mid = $this->add($newData);

    /**
     * 添加轮播图片
     */

    $carousel = json_decode($data['carousel'], true);

    if (!empty($carousel)) {

      $imgSv = new ImageSv();

      $imgSv->batchCreate($carousel, 3, $mid);
    
    }

    return $mid;
  
  }

  /**
   * 更新商户
   *
   * @param int id
   * @param array data
   *
   * @return int num
   */
  public function updateMerchant($id, $data) {
  
    return $this->update($id, $data);
  
  }

  /**
   * 查询商户列表
   *
   * @param array data
   * @param string fields
   * @param string order
   * @param int page
   * @param int pageSize
   *
   * @return array list
   */
  public function listQuery($data, $fields, $order, $page, $pageSize) {
  
    return $this->queryList($data, $fields, $order, $page, $pageSize);
  
  }

  /**
   * 查询全部商户
   *
   * @param
   *
   * @return array list
   */
  public function getAll($query, $order, $fields) {
  
    return $this->all($query, $order, $fields);
  
  }

  /**
   * 商户详情
   *
   * @param int id
   *
   * @return 
   */
  public function getDetail($id) {
  
    return $this->findOne($id); 
  
  }

}
