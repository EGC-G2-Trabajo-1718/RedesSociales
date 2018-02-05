<?php
/**
 * Test_Timeline_Widget
 *
 * Test set to test widget performance.
 *
 * @see WP_UnitTestCase
 */
class Test_Timeline_Widget extends WP_UnitTestCase {
	
	//Test that Timeline_Widget is registered in Wordpress as Widget
	function test_register_widget_core_widget() {

		global $wp_widget_factory;
		$this->assertTrue( isset( $wp_widget_factory->widgets['Timeline_Widget'] ) );

	}

	//Test that probe the construct run correctly for this widget
	function test_wp_widget_constructor() {

		$name = 'Timeline by EGC';
		$widget = new Timeline_Widget();

		$this->assertEquals( $name, $widget->name );

	}
	
	//Test that probe the base id for this widget is correct
	function test_get_baseid_widget() {

		$baseID = 'timeline-egc';
		$widget = new Timeline_Widget();

		$this->assertEquals( $baseID, $widget->getBaseID() );

	}
	
  
}
