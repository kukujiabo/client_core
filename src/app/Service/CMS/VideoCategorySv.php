<?php
namespace App\Service\CMS;

use App\Service\BaseService;
use Core\Service\CurdSv;

/**
 * 视频分类服务
 *
 * @author Meroc Chen <398515393@qq.com> 2018-02-15
 */
class VideoCategorySv extends BaseService {

  use CurdSv;

  /**
   * 添加视频分类
   *
   * @param string name
   * @param int parent
   * @param string description
   * @param int displayOrder
   * @param int status
   * @param string thumbnail
   *
   * @return int num
   */
  public function addCategory($name, $parent, $description, $displayOrder, $brief, $status, $thumbnail) {
  
    $data = [
    
      'name' => $name,

      'parent' => $parent,

      'description' => $description,

      'display_order' => $displayOrder,

      'status' => $status, 

      'thumbnail' => $thumbnail,

      'brief' => $brief,

      'created_at' => date('Y-m-d H:i:s')
    
    ];
  
    return $this->add($data);
  
  }

  /**
   * 添加视频分类
   * 
   * @param string name
   * @param int parent
   *
   * @return int id
   *
   */
  public function listQuery($query, $all, $page = 1, $pageSize = 20, $fields = '*') {

    if ($all) {
    
      $datas = $this->all($query, 'display_order desc');

      $tmpDatas = $datas;
    
    } else {
  
      $datas = $this->queryList($query, $fields, 'display_order desc', $page, $pageSize);

      $tmpDatas = $datas['list'];

    }

    $categories = [];

    foreach($tmpDatas as $data) {
    
      if ($data['parent'] > 0 && !in_array($data['parent'], $categories)) {
      
        array_push($categories, $data['parent']);
      
      }
   
    }

    $parentCondition = [ 'id' => implode(',', $categories) ];

    $parents = $this->all($parentCondition);

    foreach($tmpDatas as $key => $data) {
    
      foreach($parents as $parent) {
      
        if ($data['parent'] == $parent['id']) {
        
          $tmpDatas[$key]['parent_name'] = $parent['name'];
        
        }
      
      }

      if (!$data['parent']) {
      
        $tmpDatas[$key]['parent_name'] = '无';
      
      }
    
    } 

    if ($all) {
    
      return $tmpDatas;
    
    } else {

      $datas['list'] = $tmpDatas;
    
      return $datas;
    
    }
  
  }

  /**
   * 编辑分类
   *
   * @param int id
   * @param int id
   * @param int id
   * @param int id
   * @param int id
   * @param int id
   * @param int id
   *
   * @return int num
   */
  public function editCategory($id, $name, $parent, $description, $displayOrder, $brief, $status, $thumbnail) {
  
    $data = [];

    if (isset($id)) $data['id'] = $id;
    if (isset($name)) $data['name'] = $name;
    if (isset($parent)) $data['parent'] = $parent;
    if (isset($description)) $data['description'] = $description;
    if (isset($displayOrder)) $data['display_order'] = $displayOrder;
    if (isset($brief)) $data['brief'] = $brief;
    if (isset($status)) $data['status'] = $status;
    if (isset($thumbnail)) $data['thumbnail'] = $thumbnail;

    if (empty($data)) {
    
      return 0;
    
    } else {

      return $this->update($id, $data);

    }
  
  }

}
