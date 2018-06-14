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

}

