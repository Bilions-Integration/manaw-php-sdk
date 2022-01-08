<?php
namespace Bilions\MaNaw;

class MaNaw {
  public static $config;  

  public static function config($config) {
    self::$config = $config;
  }
}