<?php
/**
 * @file
 * FrontendTest class code.
 */

/**
 * The PHPunit test for the Frontend class.
 *
 * See the main README.md, at the root, on how to use this.
 */
class FrontendTest extends PHPUnit_Framework_TestCase
{
  /**
   * Tests that the page is available via HTTP.
   *
   * Requires that the settings file be correctly configured as per README.md.
   */
  public function testPageAvailable() {
    require_once(dirname(__FILE__) . '/../../common/src/Request.php');
    require_once(dirname(__FILE__) . '/../../common/src/EnvSettings.php');
    $request = new Request();
    $server = EnvSettings::get('frontend', 'frontend_server') . '/index.php';
    $response = $request->get($server);
    $this->assertTrue(strpos($response, 'form') !== FALSE, 'The frontend page is accessible at ' . $server . '. If this test fails, please make sure that certain files are accessible via HTTP (which is required if you want to run automated tests) as per instructions in README.md.');
  }

  /**
   * Tests that a result is correctly displayed.
   */
  public function testUIWorksError() {
    $this->_testUIWorks('bird', 'birds', 'The frontend works when there is no error');
  }

  /**
   * Tests that an error is correctly displayed.
   */
  public function testUIWorksNoError() {
    $this->_testUIWorks('&', 'words must contain between 1 and 50 letters', 'The frontend works when there is an error');
  }

  /**
   * Tests that an error is correctly displayed.
   *
   * We already know, as per $this->testPageAvailable(), that the UI works; therefore
   * we do not need to perform HTTP requests for further tests, we can call the Frontend
   * class directly.
   *
   * @param $input
   *   A string like "bird" or "&"
   *
   * @param $output
   *   The expected output, like "birds", or "words must contain between 1 and 50 letters"
   *
   * @param $message
   *   The message to dislay if the test fails.
   */
  public function _testUIWorks($input, $output, $message) {
    require_once(dirname(__FILE__) . '/../src/FakeBackend.php');
    require_once(dirname(__FILE__) . '/../src/Frontend.php');
    $frontend = new Frontend(new FakeBackend());
    $result = $frontend->getFormattedResult(array('word' => $input));
    $this->assertTrue(strpos($result, $output) !== FALSE, $message . ': "' . $output . '" should be in the result, "' . $result . '"');
  }

}
