<?php
namespace App\Service\Components\Map;

use App\Service\System\ConfigSv;
use App\Library\Http;

class TXMapSv {

  /**
   * 根据地址获取坐标
   *
   */
  public function getQqAddress($address) {

    $config = new ConfigSv();

    $qq_key = $config->getConfig('qq_key');

    $origin_uri = \PhalApi\DI()->config->get('qq.get_coordinate_uri');

    $origin_uri = str_replace('{ADDRESS}', $address, $origin_uri);

    $origin_uri = str_replace('{KEY}', $qq_key, $origin_uri);

    $result = Http::httpGet($origin_uri);

    return json_decode($result, true);

  }



}
