<?php
namespace Bilions\MaNaw;

use Bilions\MaNaw\Facades\Model;

/**
 * class to setup secret key
 *
 * @author AJ <necessarylion@gmail.com>
 * @copyright https://bilions.org
 */
class MaNaw {
  public static $config;  

  public static function config($config) {
    self::$config = $config;
  }
}