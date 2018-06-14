<?php
namespace App\Api;

/**
 * 图片资源接口
 *
 * @author Meroc Chen <398515393@qq.com> 2018-01-31
 */
class Image extends BaseApi {

  public function getRules() {
  
    return $this->rules(array(

      'upload' => array(
      
        'img_id' => 'img_id|string|true||第三方图片库id',

        'url' => 'url|string|true||图片资源地址',

        'module' => 'module|int|true||资源所属模块',

        'relat_id' => 'relat_id|int|false||关联对象id',

        'base64' => 'base64|string|false||base64编码'
      
      )
    
    ));
  
  }

  /**
   * 用户手机验证码登录
   * @desc 用户手机验证码接口
   *
   * @return boolean true/false
   */
  public function upload() {
  
    $params = $this->retriveRuleParams(__FUNCTION__);
  
    return $this->dm->upload($params['img_id'], $params['url'], $params['module'], $params['relat_id'], $params['base64']);
  
  }

}
