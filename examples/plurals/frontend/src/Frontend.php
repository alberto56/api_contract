<?php
/**
 * @file
 * Frontend class code.
 */

/**
 * Represents the frontend system.
 */
class Frontend {
  private $backend;

  public function __construct($backend)
  {
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

  public function getResult($post) {
    if (isset($post['word'])) {
      return $this->getBackend()->getPlural($post['word']);
    }
    else {
      return array('message' => 'Please input a word to get its plural');
    }
  }

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

  public function getFormattedResult($post) {
    return $this->formatResult($this->getResult($post));
  }

}
