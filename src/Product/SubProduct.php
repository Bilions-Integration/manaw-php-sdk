<?php
namespace Bilions\MaNaw\Product;

use Bilions\MaNaw\Facades\Model;

/**
 * SubProduct Object
 *
 * @author AJ <necessarylion@gmail.com>
 * @copyright https://bilions.org
 */
class SubProduct extends Model {
  /**
  * SubProduct Listing
  *
  * @param integer $id, optional $subProduct
  * @return this
  */
  public static function get($id, $subProduct = '') {
    return self::getInstance()->_custom('GET', '/group_products/' . $id . '/sub_products/' . $subProduct);
  }
}
