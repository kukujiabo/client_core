<?php
namespace App\Domain;

use App\Service\Crm\FeedbackSv;

/**
 * 意见反馈
 *
 * @author Meroc Chen <398515393@qq.com>
 */
class FeedbackDm {

  protected $_fsv;

  public function __construct() {
  
    $this->_fsv = new FeedbackSv();
  
  }

  /**
   * 添加反馈意见
   *
   * @param int $memberId
   * @param string $content
   *
   * @return int $id
   */
  public function addFeedback($memberId, $content) {
  
    return $this->_fsv->addFeedback($memberId, $content);
  
  }

}
