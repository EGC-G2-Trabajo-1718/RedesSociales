<?php
/**
 * Test_Share_Button_Widget
 *
 * Test set to test widget performance.
 *
 * @see WP_UnitTestCase
 */
class Test_Comment_Box_Widget extends WP_UnitTestCase {	
	
	// Test that Comment_Box_Widget is registered in Wordpress as Widget
	function test_register_widget_core_widget() {

		global $wp_widget_factory;
		$this->assertTrue( isset( $wp_widget_factory->widgets['Comment_Box_Widget'] ) );

	}
	
	// Test that Comment_Box_Widget is able to create
	function test_create_widget() {

		$widget = new Comment_Box_Widget();

	}
	
	// Test that probe the construct run correctly for this widget
	function test_wp_widget_constructor() {

		$name = 'Comment Box by EGC';
		$widget = new Comment_Box_Widget();

		$this->assertEquals( $name, $widget->name );

	}
	
	// Check if the entered size is correct
	function test_size1(){
		
		$size = Comment_Box_Widget::checkSize('test');
		$this->assertEquals($size, '100%', 'Error: the size is not a number');
			
	}
	
	function test_size2(){
		
		$size = Comment_Box_Widget::checkSize('-1');
		$this->assertEquals($size, '100%', 'Error: the size is negative');
			
	}
	
	function test_size3(){
		
		$size = Comment_Box_Widget::checkSize('-20&');
		$this->assertEquals($size, '100%', 'Error: the size is not correct');
			
	}
	
	// Check if the entered num is correct
	function test_num1(){
		
		$num = Comment_Box_Widget::checkNum('-2');
		$this->assertEquals($num, '5', 'Error: the number of comments is negative');
			
	}
	
	function test_num2(){
		
		$num = Comment_Box_Widget::checkNum('asd');
		$this->assertEquals($num, '5', 'Error: the number of comments is not a number');
			
	}
	
	// Check if the entered style is correct
	function test_style(){
		
		$style = Comment_Box_Widget::checkStyle('red');
		$this->assertEquals($style, 'light', 'Error: the style is not correct');
			
	}
	
	// Check if the entered background is correct
	function test_background1(){
		
		$background = Comment_Box_Widget::checkBackground('#12345');
		$this->assertEquals($background, '', 'Error: the background does not have all the characters');
			
	}
	
	function test_background2(){
		
		$background = Comment_Box_Widget::checkBackground('fff222');
		$this->assertEquals($background, '', 'Error: the background does not have the # characters');
			
	}

}

?>