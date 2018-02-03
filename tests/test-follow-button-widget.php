<?php
class Test_Follow_Button_Widget extends WP_UnitTestCase {
	

	//Tests is running
	function test_tests() {
		$this->assertTrue( true );
		return "Test are running";  
	}
	
	//Test that the wordpress plugin is activated
	function test_plugin_activated() {
	  	$this->assertTrue(is_plugin_active( "socialhub-egc/socialhub-egc.php" ),"Plugin is not active");
	  	return "Plugin activated";
  	}
	
	//Test that Follow_Button_Widget is registered in Wordpress as Widget
	/*function test_register_widget_core_widget() {
		//require 'tmp/wordpress/src/wp-content/plugins/socialhub-egc/widgets/class-follow-button-widget.php';
		include '../../../socialhub-egc';
		$widget = new Follow_Button_Widget();
		//$this->assertEquals( '..socialhub-egc/widgets/class-follow-button-widget', $widget->widget_options['classname'] );
		//global $wp_widget_factory;
		//register_widget( 'widgets/class-follow-button-widget.php' );
		//unregister_widget( 'widgets/class-follow-button-widget.php' );
		//register_widget( 'widgets/class-follow-button-widget.php' );
		//$this->assertTrue( isset( $wp_widget_factory->widgets['Follow_Button_Widget'] ) );
	}*/
	
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
		include '../../../socialhub-egc';
	}
	
	function test_5(){
		include '../../../../socialhub-egc';
	}
	
	function test_6(){
		include '../../../../../socialhub-egc';
	}
	
	function test_7(){
		include '../../../../../../socialhub-egc';
	}
	
	function test_8(){
		include '../../../../../../../socialhub-egc';
	}
	
	function test_9(){
		include '../../../../../../../../socialhub-egc';
	}
	
	function test_9(){
		include '../../../../../../../../../socialhub-egc';
	}
  
}
