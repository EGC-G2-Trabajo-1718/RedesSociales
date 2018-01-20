<?php
class Test_Plugin extends WP_UnitTestCase {
//class Test_Plugin extends PHPUnit_Framework_TestCase {

  function test_tests() {
	  $this->assertTrue( true );
	  return "Test are running";  
  }

  function test_plugin_activated() {
	  $this->assertTrue( is_plugin_active( "socialhub-egc/socialhub-egc.php" ) );
	  return "Plugin activated";
  }
  
}
