<?php
class Test_Follow_Button_Widget extends WP_UnitTestCase {
	
	//Test that Follow_Button_Widget is registered in Wordpress as Widget
	function test_register_widget_core_widget() {
		global $wp_widget_factory;
		$this->assertTrue( isset( $wp_widget_factory->widgets['Follow_Button_Widget'] ) );
	}

	//Test that Follow_Button_Widget is able to create
	function test_create_widget() {
		include_once '../socialhub-egc/widgets/class-follow-button-widget.php';
		$widget = new Follow_Button_Widget();
	}

	//Test that probe the construct run correctly for this widget
	function test_wp_widget_constructor() {
		include_once '../socialhub-egc/widgets/class-follow-button-widget.php';

		$name = 'Follow Buttons by EGC';
		$widget = new Follow_Button_Widget();

		$this->assertEquals( $name, $widget->name );
	}

	//Check that the twitter user's characters are valid
	function test_wp_widget_twitter_format() {
		include_once '../socialhub-egc/widgets/class-follow-button-widget.php';
		$widget = new Follow_Button_Widget();

		$instance = [
    			"userTwitter" => "@test",
		];
		$socialnetwork = "twitter";

		$username = $widget->getUsername($instance, $socialnetwork);

		$this->assertEquals( $username, "test", 'Error in the method "getUsername"' );
	}
	
  
}
