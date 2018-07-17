<?php
namespace App\Model;

class VBapplyMemberLoan extends BaseModel {

  protected $_queryOptionRule = [
  
    'contact' => 'like',

    'loan_name' => 'like',

    'created_at' => 'range'

  ];

}
