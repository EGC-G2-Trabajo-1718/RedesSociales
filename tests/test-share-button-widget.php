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
	function test_3() {
		$username = Share_Button_Widget::formatTwitterUsername('()te&st_2?');
		$this->assertEquals($username, 'test_2', 
			'Error in the function formatTwitterUsername: username with characters not allowed');
	}

	// Test 4: Check a tweet with only text
	// 		   getTweetParameters($tweetText, $hashtags, $sourceTweet)
	function test_4() {
		$tweetParameters = Share_Button_Widget::getTweetParameters('Test','','');
		$this->assertEquals($tweetParameters, '?text=Test', 
			'Error in the function getTweetParameters: check a tweet with only text');
	}

	// Test 5: Check a tweet with only hashtags
	function test_5() {
		$tweetParameters = Share_Button_Widget::getTweetParameters('','Test','');
		$this->assertEquals($tweetParameters, '?hashtags=Test', 
			'Error in the function getTweetParameters: check a tweet with only hashtags');
	}

	// Test 6: Check a tweet with text and hashtags
	function test_6() {
		$tweetParameters = Share_Button_Widget::getTweetParameters('Test','Test','');
		$this->assertEquals($tweetParameters, '?text=Test&hashtags=Test', 
			'Error in the function getTweetParameters: check a tweet with text and hashtags');
	}

	// Test 7: Check a tweet with only username
	function test_7() {
		$tweetParameters = Share_Button_Widget::getTweetParameters('','','Test');
		$this->assertEquals($tweetParameters, '?via=Test', 
			'Error in the function getTweetParameters: check a tweet with only username');
	}

	// Test 8: Check a tweet with text, hashtags and username
	function test_8() {
		$tweetParameters = Share_Button_Widget::getTweetParameters('Test','Test','Test');
		$this->assertEquals($tweetParameters, '?text=Test&hashtags=Test&via=Test', 
			'Error in the function getTweetParameters: check a tweet with text, hashtags and username');
	}
}
?>
