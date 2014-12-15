<?php
/**
 * @file
 * RealBackend class code.
 */

require_once(dirname(__FILE__) . '/AbstractBackend.php');
require_once(dirname(__FILE__) . '/../../common/src/Settings.php');

/**
 * An interface to real backend server
 */
class RealBackend extends AbstractBackend
{
  /**
   * Get the user for authenticating with the backend server.
   *
   * @return
   *   The username as a string.
   *
   * @throws
   *   Exception
   */
  public function getUser() {
    return Settings::get('frontend', 'user');
  }

  /**
   * Get the password for authenticating with the backend server.
   *
   * @return
   *   The password as a plain text string.
   *
   * @throws
   *   Exception
   */
  public function getPass() {
    return Settings::get('frontend', 'pass');
  }

  /**
   * Get the result from a server.
   *
   * @throws
   *   Exception
   */
  protected function getCurlResult($post) {
    require_once(dirname(__FILE__) . '/../../common/src/Request.php');
    $request = new Request();
    return $request->get(Settings::get('frontend', 'backend_server'), $post);
  }

}
