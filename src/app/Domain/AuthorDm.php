<?php
namespace App\Domain;

use App\Service\Crm\AuthorSv;

/**
 * 视频作者
 *
 * @author Meroc Chen <398515393@qq.com> 2018-02-04
 */
class AuthorDm {

  protected $_asv;

  public function __construct() {
  
    $this->_asv = new AuthorSv();
  
  }

  public function addAuthor(
  
    $memberId, 
    $acctName, 
    $acctType,
    $videoBrief,
    $workShow,
    $contact,
    $email,
    $mobile,
    $wechat,
    $qq,
    $remark = '',
    $businessEntity = '',
    $companyAddress = '',
    $website = '',
    $weibo = '',
    $businessLicense = ''
  
  ) {
  
    return $this->_asv->addAuthor(
    
      $memberId, 
      $acctName, 
      $acctType,
      $videoBrief,
      $workShow,
      $contact,
      $email,
      $mobile,
      $wechat,
      $qq,
      $remark,
      $businessEntity,
      $companyAddress,
      $website ,
      $weibo,
      $businessLicense
    
    );
  
  }


}
