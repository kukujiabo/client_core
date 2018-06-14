<?php
namespace App\Api;

/**
 * submail 管理接口
 *
 * @author Meroc Chen <398515393@qq.com> 2018-02-12
 */
class Submail extends BaseApi {

  public function getRules() {
  
    return $this->rules([

      'editSmsAppId' => [
      
        'app_id' => 'app_id|string|true||submail appId'

      ],

      'editSmsAppKey' => [
      
        'app_key' => 'app_key|string|true||submail appkey'
      
      ],
    
      'addSmsTemplate' => [
      
        'title' => 'title|string|true||短信标题',

        'sms_signature' => 'sms_signature|string|true||短信签名',

        'content' => 'content|string|true||短信内容'
      
      ],

      'getSmsTemplate' => [
      
        'template_id' => 'template_id|string|false||短信模版id'
      
      ],

      'deleteSmsTemplate' => [
      
        'template_id' => 'template_id|string|true||需要删除的模版的id'
      
      ],

      'msgLog' => [
      
        'recipient' => 'recipient|string|false||联系人手机号',

        'project' => 'project|string|false||项目编号',

        'result_status' => 'result_status|string|false||发送状态：delivered:发送成功，dropped:发送失败',

        'start_date' => 'start_date|string|false||发送开始时间，使用10位时间戳',

        'end_date' => 'end_date|string|false||发送结束时间，使用10位时间戳',

        'order_by' => 'order_by|string|false|desc|按时间排序：desc:降序，asc:升序',

        'page' => 'page|int|false|1|页码',

        'page_size' => 'page_size|int|false|20|每页数量',
      
      ],

      'getSmsBalance' => [
      
      ]
    
    ]); 
  
  }

  /**
   * 编辑 submail appid
   * @desc 编辑 submail appid
   *
   * @return int num
   */
  public function editSmsAppId() {
  
    $params = $this->retriveRuleParams(__FUNCTION__);

    return $this->dm->editSmsAppId($params['app_id']);
  
  }

  /**
   * 编辑 submail appkey
   * @desc 编辑 submail appkey
   *
   * @return int num
   */
  public function editSmsAppKey() {
  
    $params = $this->retriveRuleParams(__FUNCTION__); 

    return $this->dm->editSmsAppKey($params['app_key']);
  
  }

  /**
   * 添加短信模版
   * @desc 添加短信模版
   *
   * @return array $info
   */
  public function addSmsTemplate() {
  
    $params = $this->retriveRuleParams(__FUNCTION__); 

    return $this->dm->addSmsTemplate($params['title'], $params['sms_signature'], $params['content']);
  
  }

  /**
   * 获取短信模版
   * @desc 获取短信模版
   *
   * @return array $list
   */
  public function getSmsTemplate() {
  
    $params = $this->retriveRuleParams(__FUNCTION__); 

    return $this->dm->getSmsTemplate($params['template_id']);
                                                      
  }                                                   

  /**
   * 删除短信模版
   * @desc 删除短信模版
   *
   * @return boolean true/false
   */
  public function deleteSmsTemplate() {
  
    $params = $this->retriveRuleParams(__FUNCTION__);

    return $this->dm->deleteSmsTemplate($params['template_id']);
  
  }

  /**
   * 查询短信发送日志
   * @desc 查询短信发送日志
   *
   * @return mixed
   */
  public function msgLog() {
  
    $params = $this->retriveRuleParams(__FUNCTION__);
  
    return $this->dm->msgLog($params['recipient'], $params['project'], $params['result_status'], $params['start_date'], $params['end_date'], $params['order_by'], $params['page'], $params['page_size']);
  
  }

  /**
   * 获取短信余额
   * @desc 获取短信余额
   *
   * @return number balance
   */
  public function getSmsBalance() {
  
    return $this->dm->getSmsBalance(); 
  
  }

}
