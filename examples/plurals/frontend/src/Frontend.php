<?php
/**
 * @file
 * Frontend class code.
 */

/**
 * Represents the frontend system.
 */
class Frontend {
  // An object of class AbstractBackend, to use to communicate with either
  // the real or fake backend.
  private $backend;

  /**
   * Constructor
   *
   * @param $backend
   *   An object of class AbstractBackend.
   */
  public function __construct($backend) {
    $this->backend = $backend;
  }

  /**
   * Getter for the backend.
   *
   * @return
   *   The backend object
   */
  public function getBackend() {
    return $this->backend;
  }

  /**
   * Returns the HTML page.
   *
   * @param $post
   *   Post data
   *
   * @return
   *   HTML data
   */
  public function getPage($post) {
    return '<html>
  <body>
    <div>
      Result: ' . $this->getFormattedResult($post) . '
    </div>

    <form action="index.php" method="post">
     <p>Word: <input type="text" name="word" /></p>
     <p><input type="submit" /></p>
    </form>
  </body>
</html>';
  }

  /**
   * Get the result to display to the user based on post data
   *
   * @param $post
   *   Post data
   *
   * @return
   *   An associative array with error, message, or plural
   */
  public function getResult($post) {
    if (isset($post['word'])) {
      return $this->getBackend()->getPlural($post['word']);
    }
    else {
      return array('message' => 'Please input a word to get its plural');
    }
  }

  /**
   * Formats the result as a string
   *
   * @param $result
   *   An associative array with error, message, or plural
   *
   * @return
   *   HTML string
   */
  public function formatResult($result) {
    if (isset($result['message'])) {
      return htmlspecialchars($result['message']);
    }
    elseif (isset($result['error'])) {
      return 'An error occurred: ' . htmlspecialchars($result['error']);
    }
    elseif (isset($result['plural'])) {
      return 'The result is: ' . htmlspecialchars($result['plural']);
    }
  }

  /**
   * Returns an HTML string based on post data
   *
   * @param $post
   *   Post data as an associative array
   *
   * @return
   *   HTML string
   */
  public function getFormattedResult($post) {
    return $this->formatResult($this->getResult($post));
  }

}
