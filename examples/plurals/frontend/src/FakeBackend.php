<?php
/**
 * @file
 * FakeBackend class code.
 */

define('FAKE_BACKEND_RIGHT_CREDENTIALS', 1);
define('FAKE_BACKEND_WRONG_CREDENTIALS', 0);

require_once(dirname(__FILE__) . '/Backend.php');

class FakeBackend extends Backend {
  private $credentials;

  public function __construct() {
    $this->credentials = FAKE_BACKEND_RIGHT_CREDENTIALS;
  }

  public function simulateWrongCredentials() {
    $this->credentials = FAKE_BACKEND_WRONG_CREDENTIALS;
  }

  public function getUrl() {
    require_once(dirname(__FILE__) . '/Settings.php');
    return Settings::get('frontend_server') . '/fake-backend.php';
  }
  public function getUser() {
    return 'username';
  }
  public function getPass() {
    switch ($this->credentials) {
      case FAKE_BACKEND_RIGHT_CREDENTIALS:
        return 'password';
        break;
      default:
        return 'not-password';
        break;
    }
  }

  /**
   * This code was inspired by http://stackoverflow.com/questions/2138527
   *
   * @throws
   *   Exception
   */
  protected function getCurlResult($post) {
    require_once(dirname(__FILE__) . '/../../../../src/ApiFormatter.php');

    $api_testing = new ApiFormatter('../api');

    return $api_testing->getFormatted($post);
  }
}
