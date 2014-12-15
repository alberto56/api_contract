<?php
/**
 * @file
 * RealBackend class code.
 */

require_once(dirname(__FILE__) . '/AbstractBackend.php');
require_once(dirname(__FILE__) . '/../../common/src/EnvSettings.php');

/**
 * An interface to real backend server
 */
class RealBackend extends AbstractBackend
{
  /**
   * {@inheritdoc}
   */
  public function getUser() {
    return EnvSettings::get('frontend', 'user');
  }

  /**
   * {@inheritdoc}
   */
  public function getPass() {
    return EnvSettings::get('frontend', 'pass');
  }

  /**
   * {@inheritdoc}
   */
  protected function getCurlResult($post) {
    require_once(dirname(__FILE__) . '/../../common/src/Request.php');
    $request = new Request();
    return $request->get(EnvSettings::get('frontend', 'backend_server'), $post);
  }

}
