<?php
namespace Bilions\MaNaw\Product;

use Bilions\MaNaw\Facades\Model;

/**
 * Product Option Object
 *
 * @author AJ <necessarylion@gmail.com>
 * @copyright https://bilions.org
 */
class ProductOption extends Model {
  /**
  * Product Option
  *
  * @param integer $id
  * @return this
  */
  public static function get($id) {
    return self::getInstance()->_custom('GET', '/products/' . $id . '/product_options');
  }

  // Create Product Option
  public static function create($id, $params = []) {
    return self::getInstance()->_custom('POST', '/products/' . $id . '/product_options', $params);
  }
}
