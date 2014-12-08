<?php
/**
 * @file
 * Backend class code.
 */

abstract class Backend
{
  /**
   * Gets the plural version of a singular noun.
   *
   * This is meant as exapmle code.
   *
   * $param $singular
   *   A string
   *
   * @return
   *   An associative array, containing either the key error with a value
   *   describing the error, or the key plural with a string containing the
   *   plural noun.
   */
  public function getPlural($singular) {
    $server = $this->getUrl();
    $post = array(
      'user' => $this->getUser(),
      'pass' => $this->getPass(),
      'word' => $singular,
    );

    $server_output = $this->getCurlResult($post);
    $return = json_decode($server_output, TRUE);

    if (!isset($return['error']) && !isset($return['plural'])) {
      return array('error' => 'Internal error: the backend returned neither an error nor a response, for ' . serialize($post) . ' it returned ' . $server_output);
    }

    return $return;
  }

  public abstract function getUser();
  public abstract function getPass();

  abstract protected function getCurlResult($post);

}
