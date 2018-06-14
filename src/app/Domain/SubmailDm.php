<?php
namespace App\Domain;

use App\Service\Components\Submail\TemplateSv;
use App\Service\Components\Submail\MessageSv;
use App\Service\Components\Submail\SubmailSv;

/**
 * 赛邮接口域
 *
 * @author Meroc Chen <398515393@qq.com> 2018-02-10
 */
class SubmailDm {

  protected $_tsv;

  protected $_ssv;

  public function __construct() {
  
    $this->_tsv = new TemplateSv();

    $this->_ssv = new SubmailSv();

    $this->_msv = new MessageSv();
  
  }

  /**
   * 添加短信模版
   * 
   * @param string title
   * @param string smsSignature
   * @param string content
   *
   * return boolean true/false
   */
  public function addSmsTemplate($title, $smsSignature, $content) {
  
    $appid = $this->_ssv->getSmsAppId(); 

    $appKey = $this->_ssv->getSmsAppKey(); 

    return $this->_tsv->addSmsTemplate($appid, $appKey, $title, $smsSignature, $content);
  
  }

  /**
   * 编辑appid 
   *
   * @param string appid
   *
   * @return int num
   */
  public function editSmsAppId($appId) {
  
    return $this->_ssv->editSmsAppId($appId);
  
  }

  /**
   * 编辑appkey
   *
   * @param string appkey
   *
   * @return int num
   */
  public function editSmsAppKey($appkey) {

    return $this->_ssv->editSmsAppKey($appkey);  
  
  }

  /**
   * 获取短信模版
   *
   * @param string templateId
   *
   * @return mixed
   */
  public function getSmsTemplate($templateId) {
  
    $appid = $this->_ssv->getSmsAppId(); 

    $appKey = $this->_ssv->getSmsAppKey(); 

    return $this->_tsv->getSmsTemplate($appid, $appKey, $templateId);
  
  }

  /**
   * 删除短信模版
   *
   * @param string templateId
   *
   * @return boolean true/false
   */
  public function deleteSmsTemplate($templateId) {
  
    $appid = $this->_ssv->getSmsAppId();

    $appKey = $this->_ssv->getSmsAppKey();

    return $this->_tsv->deleteSmsTemplate($appid, $appKey, $templateId);
  
  }

  /**
   * 查询短信发送模版
   *
   * @param string recipient
   * @param string project
   * @param string resultStatus
   * @param string startDate
   * @param string endDate
   * @param string orderBy
   * @param string page
   * @param string pageSize
   *
   * @return mixed 
   */
  public function msgLog(
  
    $recipient = NULL, 
    $project = NULL, 
    $resultStatus = NULL, 
    $startDate = 0, 
    $endDate = 0, 
    $orderBy = 'desc', 
    $page = 1, 
    $pageSize = 30
  
  ) {
  
    $appid = $this->_ssv->getSmsAppId();

    $appKey = $this->_ssv->getSmsAppKey();
  
    return $this->_msv->msgLog($appid, $appKey, $recipient, $project, $resultStatus, $startDate, $endDate, $orderBy, $page, $pageSize);
  
  }

  /**
   * 获取短信余额
   *
   * @return number balance
   */
  public function getSmsBalance() {
  
    $appid = $this->_ssv->getSmsAppId();

    $appkey = $this->_ssv->getSmsAppKey();

    return $this->_msv->getSmsBalance($appid, $appkey);
  
  }

}
