<?php
namespace App\Model;

class AuditCard extends BaseModel {

  protected $_queryOptionRule = [
  
    'id' => 'in',

    'in_date' => 'range'
  
  ];

}
