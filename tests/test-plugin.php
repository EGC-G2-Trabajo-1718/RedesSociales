<?php
//class Test_Plugin extends WP_UnitTestCase {
class Test_Plugin extends PHPUnit_Framework_TestCase {
  
  // Check that that activation doesn't break
  function test_plugin_activated() {
    $this->assertTrue( is_plugin_active( PLUGIN_PATH ) );
  }
  
  //Basic Test (TEMPORALY)
  function neliovat_get_vat( $quantity ) {
	return $quantity * 0.21;
  }
  
}
