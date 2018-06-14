<?php
namespace App\Domain;

use App\Service\CMS\VideoCategorySv;

/**
 * 视频分类域
 *
 * @author Meroc Chen <398515393@qq.com> 2018-02-15
 */
class VideoCategoryDm {

  protected $_vcsv;

  public function __construct() {
  
    $this->_vcsv = new VideoCategorySv();
  
  }

  /** 
   * 添加视频分类
   *
   * @param string name
   * @param int parent
   * @param string description
   * @param int displayOrder
   * @param int status
   * @param string thumbnail
   *
   * @return int id
   */
  public function addCategory($name, $parent, $description, $displayOrder, $brief, $status, $thumbnail) {
  
    return $this->_vcsv->addCategory($name, $parent, $description, $displayOrder, $brief, $status, $thumbnail);
  
  }

  public function editCategory($id, $name, $parent, $description, $displayOrder, $brief, $status, $thumbnail) {

    return $this->_vcsv->editCategory($id, $name, $params, $description, $displayOrder, $brief, $status, $thumbnail);
  
  }

  /**
   * 查询视频分类列表
   *
   * @param string name
   * @param int parent
   * @param int status
   * @param int all
   * @param int page
   * @param int pageSize
   *
   * @return array list
   */
  public function listQuery($name, $parent, $status, $all, $page, $pageSize) { 

    $query = [];

    if ($name) $query['name'] = $name;

    if ($parent) $query['parent'] = $name;

    if ($status) $query['status'] = $name;

    return $this->_vcsv->listQuery($query, $all, $page, $pageSize);
  
  }

  /**
   * 删除视频分类
   *
   * @param int id
   * 
   * @return int num
   */
  public function remove($id) {
  
    return $this->_vcsv->remove($id);
  
  }

  /**
   * 视频分类详情
   *
   * @param int id
   *
   * @return array info
   */
  public function detail($id) {
  
    return $this->_vcsv->findOne($id);
  
  }

}
