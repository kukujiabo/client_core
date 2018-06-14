<?php
namespace App\Domain;

use App\Service\CMS\AlbumSv;
use App\Service\Crm\MemberSv;
use App\Service\Admin\AdminSv;

/**
 * 专辑
 *
 * @author Meroc Chen <398515393@qq.com> 2018-02-04
 */
class AlbumDm {

  protected $_alsv;

  public function __construct() {
  
    $this->_alsv = new AlbumSv();
  
  }

  /**
   * 添加专辑
   * @desc 添加专辑
   *
   * @param int memberId
   * @param int title
   * @param int brief
   * @param int cover
   */
  public function addAlbum($authorId, $memberId, $title, $brief, $cover, $introduction, $status) {
  
    return $this->_alsv->addAlbum($authorId, $memberId, $title, $brief, $cover, $introduction, $status);
  
  }

  /**
   * 编辑专辑信息
   * @desc 编辑专辑信息
   *
   * @param int id
   * @param string title
   * @param string brief
   * @param string cover
   * @param string status
   *
   * @return int num
   */
  public function editAlbum($id, $memberId, $title, $brief, $cover, $introduction, $status) {

    $data = [];

    if (isset($memberId)) $data['member_id'] = $memberId;
  
    if (isset($title)) $data['title'] = $title;

    if (isset($brief)) $data['brief'] = $brief;

    if (isset($cover)) $data['cover'] = $cover;

    if (isset($status)) $data['status'] = $status;

    if (isset($introduction)) $data['introduction'] = $introduction;

    return $this->_alsv->editAlbum($id, $data);
  
  }

  /**
   * 查询列表
   * @desc 查询专辑列表
   *
   * @param int memberId
   * @param int keyword
   * @param int state
   * @param int all
   * @param int page
   * @param int pageSize
   *
   * @return list data
   */
  public function listQuery($title, $authorName, $albumType, $status, $order, $all, $page, $pageSize) {

    return $this->_alsv->listQuery($title, $authorName, $albumType, $status, $order, $all, $page, $pageSize);
  
  }

  /**
   * 根据id获取专辑详情
   *
   * @param int id
   *
   * @return mixed
   */
  public function detail($id) {
  
    return $this->_alsv->findOne($id);
  
  }

  /**
   * 删除专辑
   *
   * @param int id
   *
   * @return int num
   */
  public function remove($id) {
  
    return $this->_alsv->remove($id);
  
  }

}
