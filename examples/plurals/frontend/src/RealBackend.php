<?php
/**
 * @file
 * RealBackend class code.
 */

require_once(dirname(__FILE__) . '/Backend.php');
require_once(dirname(__FILE__) . '/Settings.php');

/**
 * An interface to real backend server
 */
class RealBackend extends Backend
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
    return Settings::get('user');
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
    return Settings::get('pass');
  }

  /**
   * Get the result from a server.
   *
   * @throws
   *   Exception
   */
  protected function getCurlResult($post) {
    require_once(dirname(__FILE__) . '/Request.php');
    $request = new Request();
    return $request->get(Settings::get('backend_server'), $post);
  }

}
