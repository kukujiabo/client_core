<?php
namespace App\Model;

class VMemberAccountInfo extends BaseModel {

  protected $_queryOptionRule = [
  
    'member_name' => 'like',
    'alipay_account' => 'like',
    'alipay_realname' => 'like'
  
  ];

}
