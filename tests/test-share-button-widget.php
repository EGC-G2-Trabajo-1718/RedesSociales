<?php
include_once("../../../socialhub-egc/widgets/class-share-button-widget.php");
class Test_Share_Button_Widget extends WP_UnitTestCase {
	
	function test_button() {
		$username = Share_Button_Widget::formatTwitterUsername("$test 9");
		$this->assertEquals($username, 'test 9', 'Error in the method formatTwitterUsername');
	}
}
?>