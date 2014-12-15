<?php
/**
 * @file
 * Backend class code.
 */

class Backend
{
  /**
   * Returns the current page.
   *
   * Returns HTML code meant to be displayed on a web page.
   *
   * @param $post
   *   Post data passed from the web page.
   *
   * @return
   *   HTML code in the form of json..
   */
  public function getPage($post) {
    try {
      if (isset($post['word'])) {
        $response = array('plural' => $this->getPlural($post['word']));
      }
      else {
        $response = array('error' => 'Please post a word');
      }
    }
    catch (Exception $e) {
      $response = array('error' => get_class($e) . ': ' . $e->getMessage());
    }
    return json_encode($response);
  }

  /**
   * Gets the plural version of a singular noun.
   *
   * $param $singular
   *   A string
   *
   * @return
   *   A plural word.
   *
   * @throws
   *   Exception
   */
  public function getPlural($singular) {
    require_once(dirname(__FILE__) . '/../libraries/flourish-classes/fException.php');
    require_once(dirname(__FILE__) . '/../libraries/flourish-classes/fUnexpectedException.php');
    require_once(dirname(__FILE__) . '/../libraries/flourish-classes/fProgrammerException.php');
    require_once(dirname(__FILE__) . '/../libraries/flourish-classes/fGrammar.php');
    $return = fGrammar::pluralize($singular);
    return $return;
  }

}
