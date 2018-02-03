<?php
class Test_Follow_Button_Widget extends WP_UnitTestCase {
	
	//Test that the wordpress plugin is activated
	function test_plugin_activated() {
		include '../../../../socialhub-egc';
	  	$this->assertTrue( is_plugin_active( "socialhub-egc/socialhub-egc.php" ) );
	  	return "Plugin activated";
  	}

	// Check that the plugin is active
	function test_plugin_active() {
		// WP_Error on invalid file or 'NULL' on success 
		$result = activate_plugin('../../../socialhub-egc/socialhub-egc.php');
		$this->assertNull($result);

		return "Plugin active!";
	}

	//Tests is running
	/*function test_tests() {
		include '../../../../../socialhub-egc';
		$this->assertTrue( true );
		return "Test are running";  
	}
	
	//Test that the wordpress plugin is activated
	function test_plugin_activated() {
		include '../../../../socialhub-egc';
	  	$this->assertTrue( is_plugin_active( "socialhub-egc/socialhub-egc.php" ) );
	  	return "Plugin activated";
  	}
	
	//Test that Follow_Button_Widget is registered in Wordpress as Widget
	function test_register_widget_core_widget() {
		//require 'tmp/wordpress/src/wp-content/plugins/socialhub-egc/widgets/class-follow-button-widget.php';
		include '../../../socialhub-egc';
		$widget = new Follow_Button_Widget();
		//$this->assertEquals( '..socialhub-egc/widgets/class-follow-button-widget', $widget->widget_options['classname'] );
		//global $wp_widget_factory;
		//register_widget( 'widgets/class-follow-button-widget.php' );
		//unregister_widget( 'widgets/class-follow-button-widget.php' );
		//register_widget( 'widgets/class-follow-button-widget.php' );
		//$this->assertTrue( isset( $wp_widget_factory->widgets['Follow_Button_Widget'] ) );
	}
	
	function test_1(){
		include 'socialhub-egc';
	}
	
	function test_2(){
		include '../socialhub-egc';
	}
	
	function test_3(){
		include '../../socialhub-egc';
	}
	
	function test_4(){
		include '../../../../../../socialhub-egc';
	}*/
  
}
