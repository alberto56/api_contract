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
  public function __construct() {
    parent::__construct(dirname(__FILE__) . '/../../api');
  }

  public function testPageAvailable() {
    require_once(dirname(__FILE__) . '/../../common/src/Request.php');
    require_once(dirname(__FILE__) . '/../../common/src/EnvSettings.php');
    $request = new Request();
    $server = EnvSettings::get('frontend', 'frontend_server') . '/index.php';
    $response = $request->get($server);
    $this->assertTrue(strpos($response, 'form') !== FALSE, 'The frontend page is accessible at ' . $server . '. If this test fails, please make sure that certain files are accessible via HTTP (which is required if you want to run automated tests) as per instructions in README.md.');
  }

  public function testUIWorksError() {
    $this->_testUIWorks('bird', 'birds', 'The frontend works when there is no error');
  }

  public function testUIWorksNoError() {
    $this->_testUIWorks('&', 'words must contain between 1 and 50 letters', 'The frontend works when there is an error');
  }

  public function _testUIWorks($input, $output, $message) {
    require_once(dirname(__FILE__) . '/../src/Frontend.php');
  }

}
