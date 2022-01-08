<?php
namespace Bilions\MaNaw;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7;

/**
 * Helper Trait
 *
 * @author AJ <necessarylion@gmail.com>
 * @copyright https://bilions.org
 */
trait HelperTrait {
  /**
  * set http response result here
  *
  * @var object
  */
  protected $result;

  /**
  * set http params
  *
  * @var object
  */
  public $params = [];

  /**
   * get http client
   *
   * @return Client
   */
  public function getClient() {
    if (!isset(MaNaw::$config['secret_key'])) {
      throw new Exception('Required Secret Key');
    }
    if (isset(MaNaw::$config['url']) && !empty(MaNaw::$config['url'])) {
      $baseUri = rtrim( MaNaw::$config['url'], '/') . '/';
    } else {
      $baseUri = 'https://api.manawstore.com/v1/';
    }
    return new Client([
      'base_uri' => $baseUri,
      'headers'  => [
        'Authorization' => 'Bearer ' . MaNaw::$config['secret_key'],
      ],
    ]);
  }

  /**
   * create object
   *
   * @return this
   */
  protected function _custom($method, $route, $params = []) {
    $response     = $this->getClient()
    ->request($method, 
      ltrim($route, '/'), 
      $this->getParams($params)
    );
    $this->result = $response;
    return $this->_get();
  }

  /**
   * create object
   *
   * @return this
   */
  protected function _create() {
    $response     = $this->getClient()
    ->request('POST', 
      ltrim($this->route, '/'), 
      $this->getParams()
    );
    $this->result = $response;
    return $this->_get();
  }

  /**
   * update object
   *
   * @return this
   */
  protected function _update($id) {
    $response = $this->getClient()
    ->request('POST', 
      trim($this->route, '/') . '/' . $id . '?_method=PUT' , 
      $this->getParams()
    );
    $this->result = $response;
    return $this->_get();
  }

  /**
   * get all object
   *
   * @return this
   */
  protected function _getData() {
    $response = $this->getClient()
      ->request('GET', 
        trim($this->route, '/'), 
        ['json' => $this->params]
      );
    $this->result = $response;
    return $this->_get();
  }

  /**
   * delete object
   *
   * @return this
   */
  protected function _delete($id) {
    $response = $this->getClient()
      ->request('DELETE', 
        trim($this->route, '/') . '/' . $id, 
      );
    $this->result = $response;
    return $this->_get();
  }

  protected function getParams($p = null) {
    $params = $p ? $p : $this->params;
    if (count($params) == 0) {
      return [];
    }
    $ret    = [];
    foreach ($params as $key => $value) {
      if (substr($value, 0, 6 ) === 'file::') {
        $path  = str_replace('file::', '', $value);
        $ret[] = [
          'name'     => $key,
          'contents' => Psr7\Utils::tryFopen($path, 'r'),
        ];
      } else {
        $ret[] = [
          'name'     => $key,
          'contents' => is_array($value) ? json_encode($value) : $value,
        ];
      }
    }
    $p = [
      'multipart' => $ret, 
    ];
    return $p;
  }

  /**
   * get final result from api
   *
   * @return object
   */
  public function _get() {
    $result   = (string) $this->result->getBody();
    $result   = json_decode($result);
    return $result;
  }
}