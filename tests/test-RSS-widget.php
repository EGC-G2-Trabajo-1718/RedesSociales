<?php
/**
 * Test_Plugin
 *
 * Test that plugin is active.
 *
 * @see WP_UnitTestCase
 */
class Test_RSS extends WP_UnitTestCase {	

	//Test that Follow_Button_Widget is registered in Wordpress as Widget
	function test_register_widget_rss() {
		global $wp_widget_factory;
		$this->assertTrue( isset( $wp_widget_factory->widgets['RSS_Widget'] ) );
	}
	
	//Test that the WordPress plugin is active
	function test_2() {
	  	$this->assertTrue(is_plugin_active('socialhub-egc/socialhub-egc.php'), 'Plugin is not active!');	  	
  	}

  	//Test that probe the construct run correctly for this widget
 	function test_wp_widget_constructor() {
 
 		$name = 'RSS, Feedly and Flipboard buttons by EGC';
 		$widget = new RSS_Widget();
 
 		$this->assertEquals( $name, $widget->name );
 
 	}
}
?>