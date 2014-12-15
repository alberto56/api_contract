<?php
/**
 * @file
 * FrontendTest class code.
 */

/**
 * The PHPunit test for the Backend class.
 *
 * See the main README.md, at the root, on how to use this.
 */
class BackendTest extends PHPUnit_Framework_TestCase
{
  public function testPageAvailable() {
    require_once(dirname(__FILE__) . '/../../common/src/Request.php');
    require_once(dirname(__FILE__) . '/../../common/src/Settings.php');
    $request = new Request();
    $server = Settings::get('backend', 'backend_server') . '/index.php';
    $response = $request->get($server);
    $this->assertTrue(strpos($response, '{') !== FALSE, 'The backend page is accessible at ' . $server . '. If this test fails, please make sure you have a settings.php file');
  }

  /**
   * Tests that the correct responses are returned provided the example queries.
   *
   * This is test case which best demonstrates how API Testing can be used to
   * confirm that the server responds as expected.
   */
  public function testResponses() {
    require_once(dirname(__FILE__) . '/../../../../src/APIFormatter.php');
    $api = new ApiFormatter(dirname(__FILE__) . '/../../api');
    foreach ($api->getResponses() as $response => $requests) {
    }
  }
}
