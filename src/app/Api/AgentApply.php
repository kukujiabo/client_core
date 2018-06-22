<?php
namespace App\Api;

/**
 * 代理商申请接口
 *
 * @author Meroc Chen <398515393@qq.com>
 */
class AgentApply extends BaseApi {

  public function getRules() {
  
    return $this->rules([
    
      'create' => [
      
        'name' => 'name|string|true||姓名',
        'phone' => 'phone|string|true||电话',
        'city' => 'city|string|true||城市',
        'identity' => 'identity|string|true||身份证号',
        'member_id' => 'member_id|int|true||会员id',
      
      ],

      'accept' => [
      
        'id' => 'id|int|true||申请id'
      
      ],
    
      'edit' => [
      
        'id' => 'id|int|true||申请id',
        'name' => 'name|string|false||姓名',
        'phone' => 'phone|string|false||电话',
        'city' => 'city|string|false||城市',
        'identity' => 'identity|string|false||身份证号',
        'state' => 'state|int|false||申请状态',
        'confirm_at' => 'confirm_at|string|false||同意时间',
        'reject_at' => 'reject_at|string|false||拒绝时间'
      
      ],

      'getList' => [
      
        'name' => 'name|string|false||姓名',
        'phone' => 'phone|string|false||手机号',
        'city' => 'city|string|false||城市',
        'page' => 'page|int|false||页码',
        'page_size' => 'page_size|int|false||每页条数',
        'order' => 'order|string|false||排序', 
        'fields' => 'fields|string|false||字段'
      
      ],

      'getDetail' => [
      
        'member_id' => 'member_id|int|false||会员id',
        'id' => 'id|int|false||申请id'
      
      ]

    ]);
  
  }

  /**
   * 新建代理商申请
   * @desc 新建代理商申请
   *
   * @return int id
   */
  public function create() {
  
    return $this->dm->create($this->retriveRuleParams(__FUNCTION__)); 
  
  }

  /**
   * 编辑代理商申请
   * @desc 编辑代理商申请
   *
   * @return int num
   */
  public function edit() {
  
    return $this->dm->edit($this->retriveRuleParams(__FUNCTION__)); 
  
  }

  /**
   * 查询列表
   * @desc 查询列表
   *
   * @return array list
   */
  public function getList() {
  
    return $this->dm->getList($this->retriveRuleParams(__FUNCTION__));
  
  }

  /**
   * 查询详情
   * @desc 查询详情
   *
   * @return array data
   */
  public function getDetail() {
  
    return $this->dm->getDetail($this->retriveRuleParams(__FUNCTION__));  
  
  }

  /**
   * 同意申请
   * @desc 同意申请
   *
   * @return int num
   */
  public function accept() {
  
    return $this->dm->accept($this->retriveRuleParams(__FUNCTION__)); 
  
  }

}
