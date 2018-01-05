<?php
/**
 * Message_Button_Widget
 *
 * A buttom to send a direct message, by Twitter, to a predefined profile.
 *
 * @see WP_Widget
 */
class Message_Button_Widget extends WP_Widget {
	const BASE_ID = 'message-button-widget';

	/**
	 * Register widget with WordPress
	 *
	 */
	public function __construct() {
		// Instantiate the parent object
		parent::__construct(static::getBaseID(),
							'Message Button Widget by EGC',
							array('description' => static::getDescription()));
	}

	/**
	 * Get the base ID used to identify widgets of this type installed in a widget area
	 *
	 * @return string Widget base ID
	 */
	public static function getBaseID() {
		return static::BASE_ID;
	}

	/**
	 * Describe the functionality offered by the widget
	 *
	 * @return string Description of the widget functionality
	 */
	public static function getDescription() {
		return 'A buttom to send a direct message, by Twitter, to a predefined profile.';
	}

	/**
	 * Front-end display of widget
	 *
	 * @param array $args     Display arguments including before_title, after_title, before_widget, and after_widget
	 * @param array $instance The settings for the particular instance of the widget
	 *
	 * @return void
	 */
	public function widget($args, $instance) {
	
		
		//TWITTER
		$userTwitter = esc_attr($instance['userTwitter']);	
		$userTwitterID = esc_attr($instance['userTwitterID']);
		
		if ($userTwitter!="")
		$html .= '<div><a lang="en" class="twitter-dm-button"  href="https://twitter.com/messages/compose?recipient_id='.$userTwitterID.'" data-screen-name="'.$userTwitter.'" data-show-screen-name="false" data-size="large" data-show-count="false"> Message '.userTwitter.'</a></div>';
		
		echo $html;
	}

	/**
	 * Update a widget instance
	 *
	 * @param array $new_instance New settings for this instance as input by the user via form()
	 * @param array $old_instance Old settings for this instance
	 *
	 * @return bool|array settings to save or false to cancel saving
	 */
	public function update($new_instance, $old_instance) {
		// Save widget options
		$instance = $old_instance;
		$instance['userTwitter'] = strip_tags($new_instance['userTwitter']);
		$instance['userTwitterID'] = strip_tags($new_instance['userTwitterID']);
		//$instance[''] = strip_tags($new_instance['']); // Strips a string from HTML, XML, and PHP tags

		return $instance;
	}

	/**
	 * Settings update form
	 *
	 * @param array $instance Current settings
	 *
	 * @return void
	 */
	public function form($instance) {
		$userTwitter = esc_attr($instance['userTwitter']);
		$userTwitterID = esc_attr($instance['userTwitterID']);
		?>
		<br/><span id="info">Please, input the user who will receive de message</span>
			<p>
				<label for="<?php echo $this->get_field_id('userTwitter'); ?>">
					<?php _e('Twitter account to send direct message:'); ?> 
					<input class="widefat" id="<?php echo $this->get_field_id('userTwitter'); ?>" placeholder="@TwitterUser" name="<?php echo $this->get_field_name('userTwitter'); ?>" type="text" value="<?php echo $userTwitter; ?>" />
				</label>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('userTwitterID'); ?>">
					<?php _e('Twitter ID account to send direct message, to find the id, logged into the account you must navigate: Settings, Your data, and there is the id.'); ?> 
					<input class="widefat" id="<?php echo $this->get_field_id('userTwitterID'); ?>" placeholder="userTwitterID like (942047040904859653)" name="<?php echo $this->get_field_name('userTwitterID'); ?>" type="text" value="<?php echo $userTwitterID; ?>" />
				</label>
			</p>
		<?php

	}
}
	//AUXILIARY METHODS
	
	function getRecipientId($instance, $user){
	
		$network = ucfirst($socialnetwork);
	
		$user = apply_filters('widget_user'.$network, $instance['user'.$network]);
		$user = str_replace("@", "", $user);
	
	
		return $user;
	
	}
?>