<?php
/**
 * @file
 * APIFormatter class code.
 */

/**
 * ApiFormatter class.
 *
 * Takes an [APITesting](https://github.com/alberto56/apitesting) CSV file and formats it
 * as a web page. In your project, create a .php file which will serve as your fake
 * API, and make it look somewhat [like this](https://github.com/alberto56/apitesting/blob/dev/1/examples/plurals/frontend/fake-backend.php).
 */
if (!class_exists('ApiFormatter')):
class ApiFormatter {
  // Data taken from the CSV at contruction time and saved as an associate array.
  private $data = array();

  /**
   * Constructor
   *
   * Takes the location of a csv file's parent directory, finds the csv file named
   * api.csv in it, and stores it so it can later serve fake pages based on its structure.
   *
   * @param $location
   *   The location of a csv file's parent directory, without a trailing slash.
   */
  function __construct($location) {
    $file = fopen($location . '/post.csv', 'r');
    $header = fgetcsv($file);
    while ($line = fgetcsv($file)) {
      $row = array();
      foreach ($header as $index => $name) {
        $row[$name] = $line[$index];
      }
      $this->data[] = $row;
    }
    fclose($file);
  }

  /**
   * Returns a formatted page based on what is in our CSV file.
   *
   * Uses the environment's $_POST variable.
   *
   * Look at [this page](https://github.com/alberto56/apitesting/blob/dev/1/examples/plurals/frontend/fake-backend.php)
   * for example usage.
   *
   * @return
   *   Formatted HTML.
   */
  function getFormatted($post) {
    try {
      return $this->_getFormatted($post);
    }
    catch (Exception $e) {
      return 'An error occurred: ' . $e->getMessage() . '. You might want to try the Chrome extension Postman REST client to simulate POSTing data to this webpage';
    }
  }

  /**
   * Helper function to return formatted HTML.
   *
   * Similar to getFormatted(), but this function throws an Exception if things go wrong.
   *
   * @param $post
   *   A $_POST variable, either real for simulated.
   *
   * @return
   *   Formatted HTML
   *
   * @throws
   *   Exception
   */
  function _getFormatted($post) {
    foreach ($this->data as $data) {
      if ($this->dataValidates($data, $post)) {
        return $data['__response'];
      }
    }
    throw new Exception('No suitable response found, we could not find ' . serialize($post) . ' data to validate against any sample data');
  }

  /**
   * Return TRUE if a data row validates.
   *
   * In [APITesting](https://github.com/alberto56/apitesting), an interface between
   * a client and server is documented as a CSV file with example inputs and outputs.
   * This function takes one row of that CSV file, formatted as an associative array,
   * and returns TRUE if the $post data corresponds to it.
   *
   * @param $data
   *   An associate array corresponding to one example request response of an API, for
   *   example:
   *
   *       array(
   *         '__whatever' => 'one',
   *         '__whatever2' => 'two',
   *         'whatever3' => 'three',
   *         'whatever4' => 'four',
   *         '__whatever5' => 'five',
   *       )
   *
   *   In this case we wil return TRUE if the data passed in the $post variable
   *   corresponds to:
   *
   *       array(
   *         'whatever3' => 'three',
   *         'whatever4' => 'four',
   *       )
   *
   *   __whatever, __whatever2 and __whatever5 are ignored here because they begin with
   *   two underscores and are used, in the CSV file, for non-user data such as __type
   *   (POST or GET), __response, or any other non-user data.
   *
   * @param $post
   *   The equivalent of the environment $_POST data, either real or simulated.
   *
   * @return
   *   FALSE if the data in $post does not correspond to the data in $data, TRUE
   *   otherwise.
   */
  function dataValidates($data, $post) {
    foreach ($data as $param => $value) {
      if ($this->userParam($param)) {
        $uservalue = isset($post[$param]) ? $post[$param] : NULL;
        if ($uservalue != $value) {
          return FALSE;
        }
      }
    }
    return TRUE;
  }

  /**
   * Returns TRUE if a parameter (header name) in a csv file is a user parameter.
   *
   * User parameters are part of the example data sent to a dummy server. Other,
   * non-user parameters must begin with "__". This function checks if we are dealing
   * with a user parameter.
   *
   * @param $param
   *   A string, corresponding to header in the dummy data CSV file.
   *
   * @return
   *   FALSE if the data starts with __ (and should thus be ignored in sample data sets)
   *   or TRUE otherwise.
   */
  function userParam($param) {
    if (substr($param, 0, strlen('__')) == '__') {
      return FALSE;
    }
    else {
      return TRUE;
    }
  }

  /**
   * Returns sample requests and responses based on a csv file
   *
   * @return
   *     array(
   *       array(
   *         '__whatever' => 'one',
   *         '__whatever2' => 'two',
   *         'whatever3' => 'three',
   *         'whatever4' => 'four',
   *         '__whatever5' => 'five',
   *       ),
   */
  function getData() {
    return $this->data;
  }

  /**
   * Returns sample requests and responses formatted for consumption by a backend test.
   *
   * @return
   *     array(
   *       'response' => array(
   *         array(
   *           '__whatever' => 'one',
   *           '__whatever2' => 'two',
   *           'whatever3' => 'three',
   *           'whatever4' => 'four',
   *           '__whatever5' => 'five',
   *         ),
   *       ),
   */
  function getResponses() {
    $return = array();
    foreach ($this->GetData() as $row) {
      if (!isset($return[$row['__response']])) {
        $return[$row['__response']] = array();
      }
      $return['__response'][] = $this->removeInternal($row);
    }
    return $return;
  }

  function removeInternal($row) {
    $return = array();
    foreach ($row as $key => $data) {
      if ($this->userParam($key)) {
        $return[$key] = $data;
      }
    }
    return $return;
  }

}
endif;
