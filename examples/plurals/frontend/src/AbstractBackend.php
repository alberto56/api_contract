<?php
/**
 * @file
 * Backend class code.
 */

/**
 * Represents the backend.
 *
 * The frontend project in the plurals example is meant to demonstrate how one can use an
 * API contract to build an API consumer without communicating directly with the
 * developers of the API implementor. In this example, the API consumer is the frontend,
 * which communicates with the backend via this abstract class, which can be concretized
 * with a fake backend, which uses the example data in examples/plurals/api/post.csv; or
 * the real backend. The switch which determines which backend is actually used is defined
 * in examples/plurals/frontend/settings.php
 */
abstract class AbstractBackend
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

  /**
   * Returns the username to use as a credential to the backend.
   *
   * @return
   *   The username as string.
   */
  public abstract function getUser();

  /**
   * Returns the password to use as a credential to the backend.
   *
   * @return
   *   The password as string.
   */
  public abstract function getPass();

  /**
   * Returns the result from the backend.
   *
   * @param $post
   *   An associative array containing post data to pass to the backend.
   *
   * @return
   *   The password as string.
   */
  abstract protected function getCurlResult($post);

}
