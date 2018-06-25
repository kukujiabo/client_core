<?php
namespace App\Api;

/**
 * 商家申请入驻接口
 *
 * @author Meroc Chen <398515393@qq.com>
 */
class BusinessApply extends BaseApi {

  public function getRules() {
  
    return $this->rules([
    
      'create' => [
      
        'type' => 'type|string|true||申请类型',
        'relat_id' => 'relat_id|int|true||相关id',
        'name' => 'name|string|true||商户全称',
        'member_id' => 'member_id|int|false||会员id',
        'address' => 'address|string|true||商户地址',
        'contact' => 'contact|string|true||联系人',
        'phone' => 'phone|string|true||联系人电话',
        'wechat' => 'wechat|string|false||微信号',
        'brief' => 'brief|string|false||商户简介'
      
      ],

      'listQuery' => [
      
        'name' => 'name|string|false||商户名称',
        'contact' => 'contact|string|false||联系人姓名',
        'phone' => 'phone|string|false||联系人电话',
        'fields' => 'fields|string|false||商户字段',
        'order' => 'order|string|false||排序', 
        'page' => 'page|int|false|1|页码',
        'page_size' => 'page_size|int|false|20|每页条数'
      
      ],

      'getReferenceCards' => [
      
        'reference' => 'reference|string|true||关联',
        'page' => 'page|int|false|1|页码',
        'page_size' => 'page_size|int|false|12|每页条数'
      
      ],
    
      'getReferenceLoans' => [
      
        'reference' => 'reference|string|true||关联',
        'page' => 'page|int|false|1|页码',
        'page_size' => 'page_size|int|false|12|每页条数'
      
      ],

      'balanceCreditMoney' => [
      
        'id' => 'id|int|false||申请id'
      
      ]

    ]);
  
  }

  /**
   * 新建申请
   * @desc 新建申请
   *
   * @return int id
   */
  public function create() {
  
    return $this->dm->create($this->retriveRuleParams(__FUNCTION__));
  
  }

  /**
   * 查询列表申请
   * @desc 查询列表申请
   *
   * @return array list
   */
  public function listQuery() {
  
    return $this->dm->listQuery($this->retriveRuleParams(__FUNCTION__));
  
  }

  /**
   * 查询信用卡列表
   * @desc 查询信用卡列表
   *
   * @return
   */
  public function getReferenceCards() {
  
    return $this->dm->getReferenceCards($this->retriveRuleParams(__FUNCTION__));
  
  }

  /**
   * 查询贷款列表
   * @desc 查询贷款列表
   *
   * @return
   */
  public function getReferenceLoans() {
  
    return $this->dm->getReferenceLoans($this->retriveRuleParams(__FUNCTION__));
  
  }

  /**
   * 计算信用卡佣金
   * @desc 计算信用卡佣金
   *
   * @return int num
   */
  public function balanceCreditMoney() {
  
    return $this->dm->balanceCreditMoney($this->retriveRuleParams(__FUNCTION__));
  
  }

}
