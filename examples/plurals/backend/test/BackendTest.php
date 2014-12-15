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
    require_once(dirname(__FILE__) . '/../../common/src/EnvSettings.php');
    $request = new Request();
    $server = EnvSettings::get('backend', 'backend_server') . '/index.php';
    $response = $request->get($server);
    $this->assertTrue(strpos($response, '{') !== FALSE, 'The backend page is accessible at ' . $server . '. If this test fails, please make sure that certain files are accessible via HTTP (which is required if you want to run automated tests) as per instructions in README.md.');
  }

  /**
   * Tests that the correct responses are returned provided the example queries.
   *
   * This is test case which best demonstrates how API Testing can be used to
   * confirm that the server responds as expected.
   */
  public function testResponses() {
    require_once(dirname(__FILE__) . '/../src/Backend.php');
    require_once(dirname(__FILE__) . '/../../../../src/APIFormatter.php');
    $api = new ApiFormatter(dirname(__FILE__) . '/../../api');
    $backend = new Backend();
    // Requiring the Flourish library here will throw an Exception if the installation
    // did not include submodules, which will throw a meaningful error.
    $backend->requireFlourish();
    foreach ($api->getResponses() as $response => $requests) {
      foreach ($requests as $request) {
        $backend_response = $backend->getPage($request);
        $this->assertTrue($response == $backend_response, 'For the POST request ' . serialize($request) . ', the backend returned ' . $backend_response . '; ' . $response . ' . was expected');
      }
    }
  }
}
