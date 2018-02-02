<?php
class Test_Follow_Button_Widget extends WP_UnitTestCase {

	//Tests is running
	function test_tests() {
		$this->assertTrue( true );
		return "Test are running";  
	}
	
	//Test that the wordpress plugin is activated
	function test_plugin_activated() {
	  	$this->assertTrue( is_plugin_active( "socialhub-egc/socialhub-egc.php" ) );
	  	return "Plugin activated";
  	}
	
	//Test that Follow_Button_Widget is registered in Wordpress as Widget
	function test_register_widget_core_widget() {
		global $wp_widget_factory;
		unregister_widget( 'widgets/class-follow-button-widget.php' );
		//register_widget( '../wp-content/plugins/socialhub-egc/widgets/class-follow-button-widget.php' );
		//$this->assertTrue( isset( $wp_widget_factory->widgets['../wp-content/plugins/socialhub-egc/widgets/class-follow-button-widget.php'] ) );
	}
  
}
