<?php
  /**
   * This page collects all the test suites from sleepyMUSTACHE and runs them
   * all. As a new feature, you can add a file with the pattern
   * [name]_test.php in any module, and it will be added automagically to the
   * testing suite.
   */


  require_once(__DIR__ . '/../core/class.debug.php');
  require_once(__DIR__ . '/../core/class.sm.php');
  require_once(__DIR__ . '/smreporter.php');
  require_once(__DIR__ . '/simpletest/simpletest.php');
  
  SimpleTest::prefer(new SMReporter());
  
  require_once(__DIR__ . '/simpletest/autorun.php');


  class AllTests extends TestSuite {
    function __construct() {
      $directories = array(
        './',
        '../core',
        '../modules'
      );

      $all = '';

      // get all subdirectories
      foreach ($directories as $directory) {
        $add = glob($directory . '/*' , GLOB_ONLYDIR);

        if (is_array($all)) {
          $all = array_merge($all, $add);
        } else {
          $all = $add;
        }
      }

      $all = array_merge($all, $directories);

      foreach ($all as $directory) {
        $this->collect(
          $directory,
          new SimplePatternCollector('/_test.php/i')
        );
      }
    }
  }