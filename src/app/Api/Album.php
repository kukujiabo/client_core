<?php
namespace App\Api;

/**
 * 专辑接口
 *
 * @author Meroc Chen <398515393@qq.com> 2018-02-04
 */
class Album extends BaseApi {

  public function getRules() {
  
    return $this->rules([
    
      'addAlbum' => [

        'author_id' => 'author_id|int|true||作者id',

        'member_id' => 'member_id|int|true||会员id',

        'title' => 'title|string|true||专辑标题',

        'brief' => 'brief|string|true||专辑简介',

        'cover' => 'cover|string|true||专辑封面',
      
        'introduction' => 'introduction|string|false||专辑图文详情',

        'status' => 'status|int|false||专辑状态'
      
      ],

      'editAlbum' => [
      
        'id' => 'id|int|true||专辑id',

        'title' => 'title|string|false||专辑标题',

        'brief' => 'brief|string|false||专辑简介',

        'cover' => 'cover|string|false||专辑封面',

        'introduction' => 'introduction|string|false||专辑图文详情',

        'status' => 'status|int|false||专辑状态'
      
      ],

      'listQuery' => [
      
        'title' => 'title|string|false||标题',

        'author_name' => 'author_name|string|false||作者名称',

        'album_type' => 'album_type|string|false||专辑类型:1.官方，2.达人',

        'status' => 'status|int|false||专辑状态',

        'order' => 'order|string|false|id desc|排序',

        'all' => 'all|int|false|0|是否获取全部数据，1:是，0:否，获取全部数据时，分页参数无效',

        'page' => 'page|int|false|1|页码',
        
        'page_size' => 'page_size|int|false|20|每页数量'
      
      ],

      'detail' => [
      
        'id' => 'id|int|true||专辑id'
      
      ],

      'remove' => [
      
        'id' => 'id|int|true||专辑id'
      
      ]
    
    ]); 
  
  }

  /**
   * 添加专辑
   * @desc 添加专辑
   *
   * @return int $id
   * @return false
   */
  public function addAlbum() {
  
    $params = $this->retriveRuleParams(__FUNCTION__);
  
    return $this->dm->addAlbum(
      $params['author_id'],
      $params['member_id'], 
      $params['title'], 
      $params['brief'], 
      $params['cover'],
      $params['introduction'],
      $params['status']
    );
  
  }

  /**
   * 编辑专辑信息
   *
   * @param array $data
   */
  public function editAlbum() {
  
    $params = $this->retriveRuleParams(__FUNCTION__);

    return $this->dm->editAlbum($params['id'], $params['member_id'], $params['title'], $params['brief'], $params['cover'], $params['introduction'], $params['status']);
  
  }

  /**
   * 查询专辑列表
   * @desc 查询专辑列表
   *
   * @return array list
   * @return null 
   */
  public function listQuery() {
  
    $params = $this->retriveRuleParams(__FUNCTION__);

    return $this->dm->listQuery(
      $params['title'], 
      $params['author_name'], 
      $params['album_type'], 
      $params['status'], 
      $params['order'], 
      $params['all'], 
      $params['page'], 
      $params['page_size']
    );
  
  }

  /**
   * 根据id查询专辑详情
   * @desc 根据id查询专辑详情
   *
   * @return mixed data
   * @return false
   */
  public function detail() {
  
    $params = $this->retriveRuleParams(__FUNCTION__); 

    return $this->dm->detail($params['id']);

  }

  /**
   * 删除专辑
   * @desc 删除专辑
   *
   * @return int num
   */
  public function remove() {

    $params = $this->retriveRuleParams(__FUNCTION__); 

    return $this->dm->remove($params['id']);
  
  }

}
