<?php
/**
 * @file
 * EnvEnvSettings class code.
 */

/**
 * Interface to fetch settings stored in a settings file for a project.
 */
class EnvSettings
{
  /**
   * Fetches one setting for a project
   *
   * @param $project
   *   The project name, for example 'frontend', or 'backend'
   *
   * @param $param
   *   The paramter name for which to check.
   *
   * @return
   *   The value of the setting
   */
  static public function get($project, $param) {
    $settings = self::getAll($project);
    if (!isset($settings[$param])) {
      throw new Exception('Cannot find $settings[$param] value at ' . $file);
    }
    return $settings[$param];
  }

  /**
   * Fetches all settings for a project
   *
   * @param $project
   *   The project name, for example 'frontend', or 'backend'
   *
   * @return
   *   All settings as an associative array
   */
  static public function getAll($project) {
    $base = preg_replace('/\/common\/src$/', '', dirname(__FILE__));
    $file =  $base . '/' . $project . '/settings.php';
    if (!file_exists($file)) {
      throw new Exception('Please make sure you have created the settings files (including the one at ' . $file . ') as per the README.md');
    }
    include($file);
    if (!isset($settings)) {
      throw new Exception('No $settings declared at ' . $file);
    }
    return $settings;
  }

}
