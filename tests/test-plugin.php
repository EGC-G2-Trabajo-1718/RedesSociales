<?php
class Test_Plugin extends WP_UnitTestCase {
//class Test_Plugin extends PHPUnit_Framework_TestCase {
	
 /**
  * Run a simple test to ensure that the tests are running
  */
  function test_tests() {
	  $this->assertTrue( true );
	  echo "Test are running";
	  
  }
  
  // Check that that activation doesn't break
  function test_plugin_activated() {
	  $this->assertTrue( is_plugin_active( "socialhub-egc/socialhub-egc.php" ) );
	  echo "Plugin activated";
  }
  
  //Basic Test (TEMPORALY)
  function neliovat_get_vat( $quantity ) {
    return $quantity * 0.21;
  }
  
}
