<?php
/**
 * @file
 * FakeBackend class code.
 */

define('FAKE_BACKEND_RIGHT_CREDENTIALS', 1);
define('FAKE_BACKEND_WRONG_CREDENTIALS', 0);

require_once(dirname(__FILE__) . '/AbstractBackend.php');

/**
 * Implements the backend in the context of the frontend development.
 *
 * Allows using a fake backend which takes its data from the examples/plurals/api/post.csv
 * file.
 */
class FakeBackend extends AbstractBackend {
  // whether we should simulate that the the right or wrong credentials are used.
  // (FAKE_BACKEND_RIGHT_CREDENTIALS or FAKE_BACKEND_WRONG_CREDENTIALS)
  private $credentials;

  /**
   * Constructor, initializes to simulate the right credentials.
   */
  public function __construct() {
    $this->credentials = FAKE_BACKEND_RIGHT_CREDENTIALS;
  }

  /**
   * Simulate wrong credentials are used in the frontend to communicate with the backend.
   */
  public function simulateWrongCredentials() {
    $this->credentials = FAKE_BACKEND_WRONG_CREDENTIALS;
  }

  /**
   * {@inheritdoc}
   */
  public function getUser() {
    return 'username';
  }

  /**
   * {@inheritdoc}
   */
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
   * {@inheritdoc}
   */
  protected function getCurlResult($post) {
    require_once(dirname(__FILE__) . '/../../../../src/APIContract.php');

    $api_testing = new APIContract(dirname(__FILE__) . '/../../api');

    return $api_testing->getFormatted($post);
  }

}
