<?php
/**
 * @file
 * Settings class code.
 */

/**
 * Allows fetching settings defined in the settings.php file.
 */
class Settings {

  /**
   * Get the value for a particular setting.
   *
   * @param $param
   *   The param name we want to get
   *
   * @return
   *   The value of the setting $param
   *
   * @throws
   *   Exception
   */
  public static function get($param) {
    if (!file_exists(dirname(__FILE__) . '/../settings.php')) {
      throw new Exception('The settings.php file does not exist. This is normal if you just installed the code. Please type cp examples/plurals/frontend/example.settings.php examples/plurals/frontend/settings.php and change the values in examples/plurals/frontend/settings.php to reflect the true values of your system');
    }
    include(dirname(__FILE__) . '/../settings.php');
    if (!isset($settings[$param])) {
      throw new Exception('Attempting to get a setting parameter (' . $param . ') which is not set.');
    }
    return $settings[$param];
  }

}
