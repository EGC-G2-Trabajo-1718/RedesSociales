<?php
class Test_Plugin extends WP_UnitTestCase {
//class Test_Plugin extends PHPUnit_Framework_TestCase {
	
 /**
  * Run a simple test to ensure that the tests are running
  */
  function test_tests() {
    $this->assertTrue( true );
  }
  
  // Check that that activation doesn't break
  function test_plugin_activated() {
    $this->assertTrue( is_plugin_active( "socialhub-egc/socialhub-egc.php" ) );
  }
	
  function test_plugin_activated2() {
    $this->assertTrue( is_plugin_active( "socialhub-egc" ) );
  }
  
  //Basic Test (TEMPORALY)
  function neliovat_get_vat( $quantity ) {
    return $quantity * 0.21;
  }
  
}
