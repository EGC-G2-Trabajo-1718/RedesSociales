<?php

class Test_Plugin extends WP_UnitTestCase {	

	//Tests is running
	function test_tests() {
		$this->assertTrue( true );
		return "Tests are running";  
	}
	
	//Test that the wordpress plugin is activated
	function test_plugin_activated() {
	  	$this->assertTrue(is_plugin_active( "socialhub-egc/socialhub-egc.php" ),"Plugin is not active");
	  	return "Plugin activated";
  	}

}