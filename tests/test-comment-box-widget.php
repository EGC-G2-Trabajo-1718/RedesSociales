<?php

class Test_Comment_Box_Widget extends WP_UnitTestCase {	

	//Test that the wordpress plugin is activated
	function test_plugin_activated() {
		
	  	$this->assertTrue(is_plugin_active( "socialhub-egc/socialhub-egc.php" ),"Plugin is not active");
	  	return "Plugin activated";
		
  	}
	
	//Test that Comment_Box_Widget is registered in Wordpress as Widget
	function test_register_widget_core_widget() {

		global $wp_widget_factory;
		$this->assertTrue( isset( $wp_widget_factory->widgets['Comment_Box_Widget'] ) );

	}
	
	//Test that Comment_Box_Widget is able to create
	function test_create_widget() {

		$widget = new Comment_Box_Widget();

	}
	
	//Test that probe the construct run correctly for this widget
	function test_wp_widget_constructor() {

		$name = 'Comment Box by EGC';
		$widget = new Comment_Box_Widget();

		$this->assertEquals( $name, $widget->name );

	}

}

?>