<?php
/**
 * Test_Share_Button_Widget
 *
 * Test set to test widget performance.
 *
 * @see WP_UnitTestCase
 */
class Test_Share_Button_Widget extends WP_UnitTestCase {
	
	// Test 1: Check that the widget is correctly registered in WordPress
	function test_1() {
		$this->assertTrue(is_active_widget('Share_Button_Widget'), 'Widget is not active!');
	}

	// Test 2: Check that Twitter username is not allowed with spaces, 
	//		   so formatTwitterUsername fixes this error
	function test_2() {
		$username = Share_Button_Widget::formatTwitterUsername(' test  1 ');
		$this->assertEquals($username, 'test1', 
			'Error in the function formatTwitterUsername: username with spaces');
	}

	// Test 3: Check that Twitter username can only contain letters, numbers and underscores, 
	//         so formatTwitterUsername fixes characters not allowed
	function test_2() {
		$username = Share_Button_Widget::formatTwitterUsername('()te&st_2?');
		$this->assertEquals($username, 'test_2', 
			'Error in the function formatTwitterUsername: username with characters not allowed');
	}
}
?>
