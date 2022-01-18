<?php
namespace Bilions\MaNaw;

use Bilions\MaNaw\Facades\Model;

/**
 * Invoice Object
 *
 * @author AJ <necessarylion@gmail.com>
 * @copyright https://bilions.org
 */
class Invoice extends Model {
  protected $route = '/invoices';

  /**
  * status
  *
  * @param integer $id, $params
  * @return this
  */
  public static function status($id, $params = []) {
    return self::getInstance()->_custom('POST', '/invoices/' . $id . '/status', $params);
  }
}
