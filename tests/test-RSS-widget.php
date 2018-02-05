<?php
/**
 * Test_Plugin
 *
 * Test that plugin is active.
 *
 * @see WP_UnitTestCase
 */
class Test_RSS extends WP_UnitTestCase {

	//Test RSS_Widget is registered in Wordpress as Widget
	function test_register_widget_rss() {
		global $wp_widget_factory;
		$this->assertTrue( isset( $wp_widget_factory->widgets['RSS_Widget'] ) );
	}
	
  	//Test that probe the button RSS work correctly.
 	function test_wp_widget_constructor() {
 
 		$rss_widget = new RSS_Widget();
 		$instance = [
    			"rss" => "yes",
		];

		$args = NULL;

		//Comparar que la salida de widget contiene rss
		$widget = $rss_widget->widget($args, $instance)
		$this->assertTrue(strpos($widget, 'egc-rss-container'));
 
 	}

}
?>