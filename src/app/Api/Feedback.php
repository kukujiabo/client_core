<?php
namespace App\Api;

/**
 * 意见反馈接口
 *
 * @author Meroc Chen <398515393@qq.com> 2018-02-02
 */
class Feedback extends BaseApi {

  public function getRules() {
  
    return $this->rules([
    
      'addFeedback' => [
      
        'member_id' => 'member_id|int|true||用户id',

        'content' => 'content|string|true||反馈内容',
      
      ],

      'getList' => [
      
        'member_id' => 'member_id|int|false||会员id',
        'mobile' => 'mobile|string|false||会员手机',
        'fields' => 'fields|string|false||字段',
        'order' => 'order|int|false||排序',
        'page' => 'page|int|false|1|页码',
        'page_size' => 'page_size|int|false|12|页码'
      
      ]
    
    ]);

  }

  /**
   * 添加反馈内容
   * @desc 添加反馈内容
   *
   * @return int 新增数据id
   */
  public function addFeedback() {
  
    $params = $this->retriveRuleParams(__FUNCTION__);

    return $this->dm->addFeedback($params['member_id'], $params['content']);
  
  }

  public function getList() {
  
    $params = $this->retriveRuleParams(__FUNCTION__);
  
    return $this->dm->getList($params);
  
  }

}

