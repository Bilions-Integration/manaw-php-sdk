<?php
namespace Bilions\MaNaw;

use Bilions\MaNaw\Facades\Model;

/**
 * Discounts Object
 *
 * @author AJ <necessarylion@gmail.com>
 * @copyright https://bilions.org
 */
class Discount extends Model {
  protected $route = '/discounts';

  /**
  * toggle enable discount (enable or disable)
  *
  * @param integer $id
  * @return this
  */
  public static function toggleEnable($id) {
    return self::getInstance()->_custom('PUT', '/discounts/toggle_enable/' . $id);
  }
}
