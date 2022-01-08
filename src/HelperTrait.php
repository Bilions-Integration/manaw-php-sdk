<?php
namespace Bilions\MaNaw;

use Exception;
use GuzzleHttp\Client;

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
        'Accept'        => 'application/json',
      ],
    ]);
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
      ['json' => $this->params]
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
    ->request('PUT', 
      trim($this->route, '/') . '/' . $id, 
      ['json' => $this->params]
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