<?php
/**
 * @file
 * Request class code.
 */

/**
 * A server request
 */
class Request
{
  /**
   * Returns the output of a server with post values
   *
   * This code was inspired by http://stackoverflow.com/questions/2138527
   *
   * @param $server
   *   A server URL
   *
   * @param $post = array()
   *   An array of post paramters
   *
   * @return
   *   The output of a server
   */
  public function get($server, $post = array()) {
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $server);
    curl_setopt($ch, CURLOPT_POST, 1);

    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

    $server_output = curl_exec($ch);

    $err_number = curl_errno($ch);
    if ($err_number) {
      return json_encode(array('error' => 'An error occurred while communicating with the backend: ' . curl_error($ch)));
    }

    curl_close($ch);

    return $server_output;
  }

}
