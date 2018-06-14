<?php
namespace App\Service\Crm;

use App\Service\BaseService;
use App\Exception\LogException;
use Core\Service\CurdSv;
use App\Model\Member;

class AuthorSv extends BaseService {

  use CurdSv;

  /**
   * 添加作者
   *
   * @param string
   * @param string $memberId, 
   * @param string $acctName, 
   * @param int $acctType,
   * @param string $videoBrief,
   * @param string $workShow,
   * @param string $businessEntity,
   * @param string $companyAddress,
   * @param string $website,
   * @param string $weibo,
   * @param string $businessLicense,
   * @param string $contact,
   * @param string $email,
   * @param string $mobile,
   * @param string $wechat,
   * @param string $qq,
   * @param string $remark
   *
   * @return int $id
   */
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

    /**
     * 校验用户
     */
    $member = Member::findOne($memberId);

    if (!$member) {
    
      throw new LogException($this->_err->NOMEMMSG, $this->_err->NOMEMCODE); 
    
    } else if ($member['member_type'] == 2) {
    
      throw new LogException($this->_err->AUDITTINGMSG, $this->_err->AUDITTINGCODE);
    
    } else if ($member['member_type'] == 3) {
    
      throw new LogException($this->_err->AUEXISTMSG, $this->_err->AUEXISTCODE);
    
    }
    

    if ($acctType == 1) {

      $newAuthor = [
      
        'member_id' => $memberId,
        'account_name' => $acctName,
        'account_type' => $acctType,
        'video_brief' => $videoBrief,
        'workout_show' => $workShow,
        'contact' => $contact,
        'email' => $email,
        'mobile' => $mobile,
        'wechat' => $wechat,
        'qq' => $qq,
        'remark' => $remark
      
      ];
    
    } else {
    
      $newAuthor = [
      
        'member_id' => $memberId,
        'account_name' => $acctName,
        'account_type' => $acctType,
        'video_brief' => $videoBrief,
        'workout_show' => $workShow,
        'contact' => $contact,
        'email' => $email,
        'mobile' => $mobile,
        'wechat' => $wechat,
        'qq' => $qq,
        'remark' => $remark,
        'business_entity' => $businessEntity,
        'company_address' => $companyAddress,
        'website' => $website,
        'weibo' => $weibo,
        'business_license' => $businessLicense
      
      ];
    
    }

    $newAuthor['state'] = 0;
    $newAuthor['created_at'] = date('Y-m-d H:i:s');

    //todo transaction

    $newId = $this->add($newAuthor);

    if ($newId) {
    
      Member::update($member['id'], array('member_type' => 2));
    
    }

    return $newId;
  
  }

}
