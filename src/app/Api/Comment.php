<?php
namespace App\Api;

/**
 * 评论接口
 *
 * @author Meroc Chen <398515393@qq.com> 2018-02-25
 */
class Comment extends BaseApi {

  public function getRules() {
  
    return $this->rules([
    
      'addComment' => [
      
        'object_id' => 'object_id|int|true||评论对象id',

        'module' => 'module|int|true||评论所属模块',

        'member_id' => 'member_id|int|true||评论会员id',

        'root_id' => 'root_id|int|true||根评论id',

        'reply_to' => 'reply_to|int|false|0|回复对象id',

        'content' => 'content|string|true||评论内容'
      
      ],

      'getCommentsByObjectId' => [
      
        'object_id' => 'object_id|int|true||评论对象id',

        'module' => 'module|int|true||评论所属模块',

        'page' => 'page|int|false|1|页码',

        'page_size' => 'page_size|int|false|20|每页条数',
      
      ],

      'listQuery' => [
      
        'object_id' => 'object_id|string|false||评论对象id',

        'module' => 'module|int|false||评论对象id',

        'member_id' => 'member_id|string|false||会员id',

        'root_id' => 'root_id|string|false||根评论id',

        'reply_to' => 'reply_to|string|false||回复对象id',

        'status' => 'status|int|false|1|评论状态',

        'order' => 'order|string|false||排列顺序',

        'all' => 'all|int|false|0|是否返回全部？1:是，0:否',

        'page' => 'page|int|false|1|页码',

        'page_size' => 'page_size|int|false|20|每页条数',
      
      ]
    
    ]);
  
  }

  /**
   * 添加评论
   * @desc 添加评论
   *
   * @return int id
   */
  public function addComment() {
  
    $params = $this->retriveRuleParams(__FUNCTION__);

    return $this->dm->addComment($params['object_id'], $params['module'], $params['member_id'], $params['root_id'], $params['reply_to'], $params['content']);
  
  }

  /**
   * 根据评论对象id获取评论列表
   * @desc 根据评论对象id获取评论列表
   *
   * @return array list
   */
  public function getCommentsByObjectId() {
  
    $params = $this->retriveRuleParams(__FUNCTION__);
  
    return $this->dm->getCommentsByObjectId($params['object_id'], $params['module'], $params['page'], $params['page_size']);

  }

  /**
   * 查询评论列表
   * @desc 查询评论列表
   *
   * @return array list
   */
  public function listQuery() {
  
    $params = $this->retriveRuleParams(__FUNCTION__);

    return $this->dm->listQuery($params['object_id'], $params['module'], $params['member_id'], $params['root_id'], $params['reply_to'], $params['status'], $params['order'], $params['all'], $params['page'], $params['page_size']);
  
  }

}
