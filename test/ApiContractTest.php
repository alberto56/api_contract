<?php
/**
 * @file
 * APIContractTest class code.
 */

/**
 * Tests APIContract using PHPUnit.
 */
class APIContractTest extends PHPUnit_Framework_TestCase {

  /**
   * Test class.
   */
  function testUserParam() {
    require_once(dirname(__FILE__) . '/../src/APIContract.php');

    $APIContract = new APIContract('examples/plurals/api');

    $this->assertTrue($APIContract->userParam('whatever'), 'whatever is recognized as a user parameter because it does not start with __');
    $this->assertFalse($APIContract->userParam('__whatever'), '__whatever is recognized as a system parameter because it starts with __');
  }

}
