<?php
/**
 * Test_Plugin
 *
 * Test that plugin is active.
 *
 * @see WP_UnitTestCase
 */
class Test_Plugin extends WP_UnitTestCase {	

	// Test that PHPUnit works
	function test_1() {
		$this->assertTrue(true); 
	}
	
	// Test that the WordPress plugin is active
	function test_2() {
	  	$this->assertTrue(is_plugin_active('socialhub-egc/socialhub-egc.php'), 'Plugin is not active!');	  	
  	}
}
?>
