<?php
namespace App\Api;

/**
 * 信贷产品申请接口
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
        'brief' => 'brief|string|false||商户简介',
        'reference' => 'reference|string|false||推荐人编号'
      
      ],

      'listCardQuery' => [
      
        'name' => 'name|string|false||商户名称',
        'contact' => 'contact|string|false||联系人姓名',
        'phone' => 'phone|string|false||联系人电话',
        'fields' => 'fields|string|false||商户字段',
        'order' => 'order|string|false||排序', 
        'page' => 'page|int|false|1|页码',
        'page_size' => 'page_size|int|false|20|每页条数'
      
      ],

      'listLoanQuery' => [
      
        'name' => 'name|string|false||商户名称',
        'contact' => 'contact|string|false||联系人姓名',
        'loan_name' => 'loan_name|string|false||贷款名称',
        'phone' => 'phone|string|false||联系人电话',
        'fields' => 'fields|string|false||商户字段',
        'order' => 'order|string|false||排序', 
        'page' => 'page|int|false|1|页码',
        'page_size' => 'page_size|int|false|20|每页条数'
      
      ],

      'getReferenceCards' => [
      
        'member_id' => 'member_id|int|true||用户id',
        'name' => 'name|string|false||用户姓名',
        'card_name' => 'card_name|string|false||信用卡名称',
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
      
      ],

      'balanceLoanMoney' => [
      
        'id' => 'id|int|false||申请id'
      
      ],

      'auditPass' => [
      
        'id' => 'id|int|true||申请id'
      
      ],

      'auditFail' => [
      
        'id' => 'id|int|true||申请id'
      
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
   * 查询信用卡申请
   * @desc 查询列表申请
   *
   * @return array list
   */
  public function listCardQuery() {
  
    return $this->dm->listCardQuery($this->retriveRuleParams(__FUNCTION__));
  
  }

  /**
   * 查询贷款申请
   * @desc 查询列表申请
   *
   * @return array list
   */
  public function listLoanQuery() {
  
    return $this->dm->listLoanQuery($this->retriveRuleParams(__FUNCTION__));
  
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

  /**
   * 计算贷款佣金
   * @desc 计算贷款佣金
   *
   * @return int num
   */
  public function balanceLoanMoney() {
  
    return $this->dm->balanceLoanMoney($this->retriveRuleParams(__FUNCTION__));
  
  }

  /**
   * 审核通过
   * @desc 审核通过
   *
   * @return int num
   */
  public function auditPass() {
  
    return $this->dm->auditPass($this->retriveRuleParams(__FUNCTION__)); 
  
  }

  /**
   * 驳回申请
   * @Desc 驳回申请
   *
   * @return int num
   */
  public function auditFail() {
  
    return $this->dm->auditFail($this->retriveRuleParams(__FUNCTION__)); 
  
  }

}
