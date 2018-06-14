<?php
namespace App\Api;

/**
 * 视频分类接口
 *
 * @author Meroc Chen <398515393@qq.com> 2018-02-15
 */
class VideoCategory extends BaseApi {

  public function getRules() {
  
    return $this->rules([
    
      'addCategory' => [
      
        'name' => 'name|string|true||分类名称',

        'parent' => 'parent|int|false||上级分类id',

        'description' => 'description|string|false||分类描述',

        'display_order' => 'display_order|int|false||排序，值越大越靠前',

        'status' => 'status|int|false||分类状态：1.启用，2.禁用',
        
        'brief' => 'brief|string|false||分类简介',

        'thumbnail' => 'thumbnail|string|false||分类图标'
      
      ],

      'editCategory' => [
      
        'id' => 'id|int|true||分类id',
      
        'name' => 'name|string|false||分类名称',

        'parent' => 'parent|int|false||上级分类id',

        'description' => 'description|string|false||分类描述',

        'display_order' => 'display_order|int|false||排序，值越大越靠前',

        'status' => 'status|int|false||分类状态：1.启用，2.禁用',
        
        'brief' => 'brief|string|false||分类简介',

        'thumbnail' => 'thumbnail|string|false||分类图标'
      
      ],

      'listQuery' => [
      
        'name' => 'name|string|false||分类名称',

        'parent' => 'parent|int|false||上级分类id',

        'status' => 'status|int|false||分类状态',

        'all' => 'all|int|false|0|是否查询所有分类',

        'page' => 'page|int|false|1|页码',

        'page_size' => 'page_size|int|false|20|每页条数',
      
      ],

      'detail' => [

        'id' => 'id|int|true||分类id'
      
      ],

      'remove' => [
      
        'id' => 'id|int|true||分类id'
      
      ]
    
    ]);
  
  }

  /**
   * 添加分类
   *
   * @return int id
   */
  public function addCategory() {
  
    $params = $this->retriveRuleParams(__FUNCTION__);

    return $this->dm->addCategory($params['name'], $params['parent'], $params['description'], $params['display_order'], $params['brief'], $params['status'], $params['thumbnail']);
  
  }

  /**
   * 查询分类列表
   *
   * @return array list
   */
  public function listQuery() {
  
    $params = $this->retriveRuleParams(__FUNCTION__);

    return $this->dm->listQuery($params['name'], $params['parent'], $params['status'], $params['all'], $params['page'], $params['page_size']);
  
  }

  /**
   * 编辑分类
   * @desc 编辑分类
   *
   * @return int num
   */
  public function editCategory() {
  
    $params = $this->retriveRuleParams(__FUNCTION__);

    return $this->dm->editCategory(
      $params['id'],
      $params['name'], 
      $params['parent'], 
      $params['description'], 
      $params['display_order'], 
      $params['brief'], 
      $params['status'], 
      $params['thumbnail']
    );
  
  }

  /**
   * 分类详情
   * @desc 分类详情
   *
   * @return array list
   */
  public function detail() {

    $params = $this->retriveRuleParams(__FUNCTION__); 

    return $this->dm->detail($params['id']);
  
  }

  /**
   * 删除分类
   * @desc 删除分类
   *
   * @return int 
   */
  public function remove() {
  
    $params = $this->retriveRuleParams(__FUNCTION__); 

    return $this->dm->remove($params['id']);

  }

}
