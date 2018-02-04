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
		echo "--------------------------";
		echo " TEST SHARE BUTTON WIDGET ";
		echo "--------------------------";
		echo "Test 1... ";
		$this->assertTrue(is_active_widget('Share_Button_Widget'), 'Widget is not active!');
	}
}
?>
