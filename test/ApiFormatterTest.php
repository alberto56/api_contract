<?php
/**
 * @file
 * ApiFormatterTest class code.
 */

class ApiFormatterTest extends PHPUnit_Framework_TestCase {

  function testUserParam() {
    require_once(dirname(__FILE__) . '/../src/ApiFormatter.php');

    $apiFormatter = new ApiFormatter('examples/plurals/api');

    $this->assertTrue($apiFormatter->userParam('whatever'), 'whatever is recognized as a user parameter because it does not start with __');
    $this->assertFalse($apiFormatter->userParam('__whatever'), '__whatever is recognized as a system parameter because it starts with __');
  }

}
