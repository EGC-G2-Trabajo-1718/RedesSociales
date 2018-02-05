<?php
/**
 * Test_Message_Button_Widget
 *
 * Test set to test widget performance.
 *
 * @see WP_UnitTestCase
 */
class Test_Message_Button_Widget extends WP_UnitTestCase {
	
	//Test that Message_Button_Widget is registered in Wordpress as Widget
	function test_register_widget_core_widget() {

		global $wp_widget_factory;
		$this->assertTrue( isset( $wp_widget_factory->widgets['Message_Button_Widget'] ) );

	}

	//Test that probe the construct run correctly for this widget
	function test_wp_widget_constructor() {

		$name = 'Message Button Widget by EGC';
		$widget = new Message_Button_Widget();

		$this->assertEquals( $name, $widget->name );

	}
	
	//Test that probe the base id for this widget is correct
	function test_get_baseid_widget() {

		$baseID = 'message-button-widget';
		$widget = new Message_Button_Widget();

		$this->assertEquals( $baseID, $widget->getBaseID() );

	}
	
	//Test that the message send by twitter is correctly formatted
	function test_format_twitter_message() {
		
		$widget = new Message_Button_Widget();

		$instance = array();
		$message = "This is a test message";

		$this->assertEquals( "This%20is%20a%20test%20message", $widget->getMessageFormateado($instance, $message) );

	}
	
  
}
