<?php
namespace App\Domain;

use App\Service\Comment\CommentSv;
use App\Service\Comment\MemberCommentSv;

/**
 * 评论处理域
 *
 * @author Meroc Chen <398515393@qq.com> 2018-02-24
 */
class CommentDm {

  protected $_csv;

  protected $_mcsv;

  public function __construct() {
  
    $this->_csv = new CommentSv();
  
    $this->_mcsv = new MemberCommentSv();
  
  }

  /**
   * 添加评论
   * 
   * @param int memberId
   * @param int module
   * @param int objectId
   * @param int rootId
   * @param int replyTo
   * @param string content
   *
   * @return int id
   */
  public function addComment($memberId, $module, $objectId, $rootId, $replyTo, $content) {
  
    return $this->_csv->addComment($memberId, $module, $objectId, $rootId, $replyTo, $content);
  
  }

  /**
   * 根据评论对象id获取评论列表
   *
   * @param int objectId
   * @param int module
   * @param int page
   * @param int pageSize
   *
   * @return array list
   */
  public function getCommentsByObjectId($objectId, $module, $page, $pageSize) {
  
    return $this->_mcsv->getCommentsByObjectId($objectId, $module, $page, $pageSize);
  
  }

  /**
   * 用户评论列表
   *
   * @param int objectId
   * @param string memberId
   * @param string rootId
   * @param string replyTo
   * @param string order
   * @param int page
   * @param int pageSize
   * @param string fields
   *
   * @return array list
   *
   */
  public function listQuery($objectId, $module, $memberId = null, $rootId = null, $replyTo = null, $status = 1, $order = '', $all = 0, $page = 1, $pageSize = 20) {
  
    return $this->_mcsv->listQuery($objectId, $module, $memberId, $rootId, $replyTo, $status, $order, $all, $page, $pageSize);
  
  }

}
