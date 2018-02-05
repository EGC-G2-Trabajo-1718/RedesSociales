<?php
/**
 * Test_RSS
 *
 * Test set to test widget performance.
 *
 * @see WP_UnitTestCase
 */
class Test_RSS extends WP_UnitTestCase {

	//Test RSS_Widget is registered in Wordpress as Widget
	function test_register_widget_rss() {
		global $wp_widget_factory;
		$this->assertTrue( isset( $wp_widget_factory->widgets['RSS_Widget'] ) );
	}
	
  	//Test must return an empty string if the parameter is not "yes".
 	function test_is_disable() {


 		$result = RSS_Widget::isActivated("no");
 		$this->assertEquals("", $result, "Function does not work properly.");
 
 	}

 	//Test must return "yes" if the parameter is "yes"
 	function test_is_activated() {

 		$result = RSS_Widget::isActivated("yes");
 		$this->assertEquals("yes", $result, "Function does not work properly.")
 
 	}

}
?>