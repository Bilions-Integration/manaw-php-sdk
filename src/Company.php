<?php
namespace Bilions\MaNaw;

use Bilions\MaNaw\Facades\Model;

/**
 * Company Object
 *
 * @author AJ <necessarylion@gmail.com>
 * @copyright https://bilions.org
 */
class Company extends Model {
  protected $route = '/companies';

  /**
  * Company Setting Color
  * @param string $color
  * @return this
  */
  public static function settingColor($color) {
    return self::getInstance()->_custom('POST', '/company/setting/color', [
      'color' => $color,
    ]);
  }
}
