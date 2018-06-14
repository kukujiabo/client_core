<?php
namespace App\Domain;

use App\Service\Resource\ImageSv;
use App\Service\Crm\MemberSv;

class ImageDm {

  protected $_imgSv;

  public function __construct() {
  
    $this->_imgSv = new ImageSv();

  }

  /**
   * 图片资源上传处理
   *
   * @param string $imgId  
   * @param string $url
   * @param string $module
   * @param string $relatId
   * @param string $base64
   *
   * @return
   */
  public function upload($imgId, $url, $module, $relatId = '', $base64 = '') {

    return $this->_imgSv->addImageResource($imgId, $url, $module, $relatId, $base64);
  
  }

}
