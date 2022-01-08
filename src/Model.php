<?php
namespace Bilions\MaNaw;

/**
 * MaNaw Helper class
 *
 * @author AJ <necessarylion@gmail.com>
 * @copyright https://bilions.org
 */
class Model {
  use HelperTrait;
  /**
   * instance
   * 
   * @var this
   */
  private static $instance = null;

  /**
   * get instance
   *
   * @return this
   */
  public static function getInstance() {
    if (self::$instance === null) {
      self::$instance = new static;
    }
    return self::$instance;
  }

  /**
   * create object
   *
   * @param array $params
   * @return this
   */
  public static function create($params) {
    return self::getInstance()->setParams($params)->_create();
  }

  /**
   * update object
   *
   * @param array $params
   * @param integer $id
   * @return this
   */
  public static function update($params, $id) {
    return self::getInstance()->setParams($params)->_update($id);
  }

  /**
   * get all objects with pagination
   *
   * @param array $params
   * @return this
   */
  public static function get($params) {
    return self::getInstance()->setParams($params)->_getData();
  }

  /**
   * delete object
   *
   * @param integer $id
   * @return this
   */
  public static function delete($id) {
    return self::getInstance()->_delete($id);
  }

  /**
   * set params
   *
   * @param [type] $params
   * @return this
   */
  public function setParams($params) {
    $this->params = $params;
    return $this;
  }
}