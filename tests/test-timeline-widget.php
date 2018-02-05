<?php
/**
 * Test_Timeline_Widget
 *
 * Test set to test widget performance.
 *
 * @see WP_UnitTestCase
 */
class Test_Timeline_Widget extends WP_UnitTestCase {
	
	// Test 1: Check that the widget is correctly registered in WordPress
	function test_widget_registered() {
		global $wp_widget_factory;
		$this->assertTrue(isset($wp_widget_factory->widgets['Timeline_Widget']), 'Widget is not registered!');
	}

	// Test 2: Check the height is correct with checkHeight function
	//		   If you enter a word in the form, the default value is returned (300)
	function test_check_height_timeline_1() {
		$res = Timeline_Widget::checkHeight('Test');
		$this->assertTrue($res == 300, 'Error in checkHeight function: a word is not a number');
	}

	// Test 3: Check the height is correct with checkHeight function
	//		   If you enter a negative number, the default value (300) is returned
	function test_check_height_timeline_2() {
		$res = Timeline_Widget::checkHeight(-300);
		$this->assertTrue($res == 300, 'Error in checkHeight function: negative number');
	}

	// Test 4: Check the height is correct with checkHeight function
	//         If you enter a correct value, this value is returned
	function test_check_height_timeline_3() {
		$res = Timeline_Widget::checkHeight(315);
		$this->assertTrue($res == 315, 'Error in checkHeight function: positive number is not returned');
	}

	// Test 5: Check the height is correct with checkWidth function
	//		   If you enter a word in the form, the default value is returned (300)
	function test_check_width_timeline_1() {
		$res = Timeline_Widget::checkWidth('Test');
		$this->assertTrue($res == 100, 'Error in checkWidth function: a word is not a number');
	}

	// Test 6: Check the height is correct with checkWidth function
	//		   If you enter a negative number, the default value (300) is returned
	function test_check_width_timeline_2() {
		$res = Timeline_Widget::checkWidth(-100);
		$this->assertTrue($res == 100, 'Error in checkWidth function: negative number');
	}

	// Test 7: Check the height is correct with checkWidth function
	//         If you enter a correct value, this value is returned
	function test_check_width_timeline_3() {
		$res = Timeline_Widget::checkWidth(120);
		$this->assertTrue($res == 120, 'Error in checkWidth function: positive number is not returned');
	}
}