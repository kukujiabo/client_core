<?php
namespace App\Api;

/**
 * 作者信息接口
 *
 * @author Meroc Chen <398515393@qq.com> 2018-02-04
 */
class Author extends BaseApi {

  public function getRules() {
  
    return $this->rules([

      'addAuthor' => [
    
        'member_id' => 'member_id|int|true||会员id',
        'account_name' => 'account_name|string|true||账户名称',
        'account_type' => 'account_type|int|true||账户类型',
        'video_brief' => 'video_brief|string|true||视频简介',
        'workout_show' => 'workout_show|string|false||作品链接，用空格分隔',
        'contact' => 'contact|string|true||联系人',
        'email' => 'email|string|true||联系人邮箱',
        'mobile' => 'mobile|string|true||联系人手机号',
        'wechat' => 'wechat|string|true||联系人微信',
        'qq' => 'qq|string|true||联系人qq',
        'remark' => 'remark|string|true||备注信息',
        'business_entity' => 'business_entity|string|false||运营主体',
        'company_address' => 'company_address|string|false||运营主体地址',
        'website' => 'website|string|false||运营主体网站',
        'weibo' => 'weibo|string|false||运营主体微博',
        'business_license' => 'business_license|string|false||会员id'

      ]
    
    ]);
  
  }

  /**
   * 添加作者信息接口
   * @desc 添加作者信息接口
   *
   * @return int $id 新增作者id
   */
  public function addAuthor() {
  
    $params = $this->retriveRuleParams(__FUNCTION__);

    return $this->dm->addAuthor(
    
      $params['member_id'],
      $params['account_name'],
      $params['account_type'],
      $params['video_brief'],
      $params['workout_show'],
      $params['contact'],
      $params['email'],
      $params['mobile'],
      $params['wechat'],
      $params['qq'],
      $params['remark'],
      $params['business_entity'],
      $params['company_address'],
      $params['website'],
      $params['weibo'],
      $params['business_license']
    
    );
  
  }

}
