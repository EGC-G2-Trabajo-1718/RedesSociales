<?php

class Test_Share_Button_Widget extends WP_UnitTestCase {
	
	function test_button() {
		$username = Share_Button_Widget::formatTwitterUsername('(test 9');
		$this->assertEquals($username, 'test9', 'Error in the method formatTwitterUsername');
	}
}
?>
