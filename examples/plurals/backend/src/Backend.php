<?php
/**
 * @file
 * Backend class code.
 */

/**
 * Implements the API implementor as a backend in the context of the backend
 * project. This class does the actual implementation, and is tested (see
 * examples/plurals/backend/test/BackendTest.php) to make sure it returns
 * the correct data which is defined in our examples/plurals/api/post.csv file.
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
      if ($error = !$this->credentialsOK($post)) {
        $response = array('error' => 'wrong credentials');
      }
      elseif ($error = $this->getWordError($post['word'])) {
        $response = array('error' => $error);
      }
      elseif (isset($post['word'])) {
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
   * Checks whether the credentials are OK
   *
   * $post['user'] and $post['pass'] should match what's defined in
   * examples/plurals/backend/settings.php
   *
   * @param $post
   *   An associative array with ['user'] and ['pass']
   *
   * @return
   *   TRUE if the credentials match, FALSE otherwise.
   *
   * @throws
   *   Exception
   */
  function credentialsOK($post) {
    require_once(dirname(__FILE__) . '/../../common/src/EnvSettings.php');
    $settings = EnvSettings::getAll('backend');
    foreach (array('user', 'pass') as $item) {
      $value = NULL;
      if (isset($post[$item])) {
        $value = $post[$item];
      }
      if ($value != $settings[$item]) {
        return FALSE;
      }
    }
    return TRUE;
  }

  /**
   * Returns an error string if the word cannot be made plural
   *
   * @param $word
   *   The word, as a string.
   *
   * @return
   *   An error message if the word is not pluralizable, or NULL if it is.
   */
  function getWordError($word) {
    if (!preg_match('/^[A-Za-z]*$/', $word)) {
      return 'words must contain between 1 and 50 letters';
    }
    if (!strlen($word)) {
      return 'words must contain between 1 and 50 letters';
    }
    if (strlen($word) > 50) {
      return 'words must contain between 1 and 50 letters';
    }
    return NULL;
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
    $this->requireFlourish();
    $return = fGrammar::pluralize($singular);
    return $return;
  }

  /**
   * Require external Flourish library.
   *
   * @throws
   *   Exception
   */
  function requireFlourish() {
    $base = dirname(__FILE__) . '/../libraries/flourish-classes';
    if (!file_exists($base . '/fGrammar.php')) {
      throw new Exception('Cannot find the Flourish library. Please make sure you ran the install steps, including git submodule related steps, as described in README.md');
    }
    // The exceptions classes are necessary in case a problem occurs.
    require_once($base . '/fException.php');
    require_once($base . '/fUnexpectedException.php');
    require_once($base . '/fProgrammerException.php');
    require_once($base . '/fGrammar.php');
  }

}
