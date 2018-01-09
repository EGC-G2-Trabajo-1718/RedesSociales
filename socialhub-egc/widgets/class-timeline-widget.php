<?php
/**
 * Timeline_Widget
 *
 * This widget implements the timeline for a user social network.
 *
 * @see WP_Widget
 */
class Timeline_Widget extends WP_Widget {
	const BASE_ID = 'timeline-egc';

	/**
	 * Register widget with WordPress
	 *
	 */
	public function __construct() {
		// Instantiate the parent object
		parent::__construct(static::getBaseID(),
							'Timeline by EGC',
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
		return 'This widget implements the timeline for a user social network.';
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
		// Widget output
		
		
		//TWITTER
		$user = $instance['userTwitter'];	
		if ($user!="")
		
		echo '<a class="twitter-timeline" data-lang="en" data-theme="dark" 
		 data-width="350" data-height="350"
		data-link-color="#19CF86"
		href="https://twitter.com/'.$user.'">
		Tweets by '.$user.'</a>';
		
		
		//FACEBOOK - EL USER AQUI ES LA PÁGINA QUE QUERAMOS VISUALIZAR
		$user = $instance['userFacebook'];	
		if ($user!="")
			echo '<div class="fb-page" data-href="https://www.facebook.com/'.$user.'" 
				data-tabs="timeline" data-small-header="true" data-adapt-container-width="true"
				data-hide-cover="false" data-show-facepile="false"><blockquote cite="https://www.facebook.com/'.$user.'"
				class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/'.$user.'"></a></blockquote></div>';			
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
		$instance['userFacebook'] = strip_tags($new_instance['userFacebook']);
		$instance = $new_instance;

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
		// Output admin widget options form
		
		//Getting usernames
		$userTwitter = esc_attr($instance['userTwitter']);		
		
        ?>
			<br/><span id="info">Please, input the account whose information will be shown in the timeline</span>
			<p>
				<label for="<?php echo $this->get_field_id('userTwitter'); ?>">
					<?php _e('Twitter account:'); ?> 
					<input class="widefat" id="<?php echo $this->get_field_id('userTwitter'); ?>" placeholder="TwitterUser" name="<?php echo $this->get_field_name('userTwitter'); ?>" type="text" value="<?php echo $userTwitter; ?>" />
				</label>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('userFacebook'); ?>">
					<?php _e('Facebook page:'); ?> 
					<input class="widefat" id="<?php echo $this->get_field_id('userFacebook'); ?>" placeholder="Facebook page" name="<?php echo $this->get_field_name('userFacebook'); ?>" type="text" value="<?php echo $userFacebook; ?>" />
				</label>
			</p>
			
			
			
        <?php 
	}
}

?>
