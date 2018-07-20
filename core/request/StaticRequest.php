<?php
namespace Core\Request;

use PhalApi\Request;

/**
 * 伪静态请求地址
 *
 * @author Meroc Chen <398515393@qq.com> 2017-11-24
 */
class StaticRequest extends Request {

  public function getService() {
  
    $route = $_SERVER['REQUEST_URI'];

    $service = str_replace('/index.php/', '', $route);

    if (strpos('?', $service) > 0) {

      $exArr = explode('?', $service);

      $service = $exArr[0];

    }

    if (!empty($service)) {

      $namespace = count(explode('/', $service)) == 2 ? 'App.' : '';

      return $namespace . str_replace('/', '.', $service);
    
    }

  }


