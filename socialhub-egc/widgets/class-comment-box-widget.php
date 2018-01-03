<?php
/**
 * Comment_Box_Widget
 *
 * Box of comments that are made from the Facebook user.
 *
 * @see WP_Widget
 */
class Comment_Box_Widget extends WP_Widget {
	const BASE_ID = 'comment-box-egc';
	
	/**
	 * Register widget with WordPress
	 *
	 */
	public function __construct() {
		// Instantiate the parent object
		parent::__construct(static::getBaseID(),
							'Comment Box by EGC',
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
		return 'Box of comments that are made from the Facebook user.';
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
	
		//Getting configuration values
		$size = esc_attr($instance['size']);
		$num = esc_attr($instance['num']);
		$style = esc_attr($instance['style']);
	?>
		<strong>BOX OF COMMENT</strong>
		<div class="fb-comments" data-href="<?php the_permalink(); ?>" 
			data-width="<?php if($size!="") echo $size; else echo "100%" ?>" 
			data-numposts="<?php if($num!="") echo $num; else echo "5" ?>"
			data-colorscheme="<?php if($style=="light" or $style=="dark") echo $style; else echo "light" ?>"
			data-order-by="reverse_time"></div>
	<?php
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
		$instance['moderatorFacebookID'] = strip_tags($new_instance['moderatorFacebookID']);
		$instance['size'] = strip_tags($new_instance['size']);
		$instance['num'] = strip_tags($new_instance['num']);
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
		
		//Getting configuration values
		$moderatorFacebookID = esc_attr($instance['moderatorFacebookID']);
		$size = esc_attr($instance['size']);
		$num = esc_attr($instance['num']);
		$style = esc_attr($instance['style']);
		
		?> 
		
		<strong>Moderators</strong>
		<br/><span id="info">Please, input the Facebook profile <a href="https://developers.facebook.com/tools/explorer/?method=GET&path=me" target="blank">IDs</a> separates by coma to give moderator permissions:</span>
		<p>
			<label for="<?php echo $this->get_field_id('moderatorFacebookID'); ?>">
				<input class="widefat" id="<?php echo $this->get_field_id('moderatorFacebookID'); ?>" placeholder="ModeratorID" name="<?php echo $this->get_field_name('moderatorFacebookID'); ?>" type="text" value="<?php echo $moderatorFacebookID; ?>" />
			</label>
		</p>
		<strong>Size</strong>
		<br/><span id="info">Enter the size of the widget (on pixel or %, default value = 100%):</span>
		<p>
			<label for="<?php echo $this->get_field_id('size'); ?>">
				<input class="widefat" id="<?php echo $this->get_field_id('size'); ?>" name="<?php echo $this->get_field_name('size'); ?>" type="text" value="<?php echo $size; ?>" />
			</label>
		</p>
		<strong>Num of comments</strong>
		<br/><span id="info">Enter the number of comments to show (default value = 5):</span>
		<p>
			<label for="<?php echo $this->get_field_id('num'); ?>">
				<input class="widefat" id="<?php echo $this->get_field_id('num'); ?>" name="<?php echo $this->get_field_name('num'); ?>" type="text" value="<?php echo $num; ?>" />
			</label>
		</p>
		<strong>Style</strong>
		<br/><span id="info">Enter the style light or dark (default value = light):</span>
		<p>
			<label for="<?php echo $this->get_field_id('style'); ?>">
				<input class="widefat" id="<?php echo $this->get_field_id('style'); ?>" name="<?php echo $this->get_field_name('style'); ?>" type="text" value="<?php echo $style; ?>" />
			</label>
		</p>
<?php
	moderator($instance);
	}
}

//AUXILIARY METHODS

function moderator($instance) { // ERROR, tenog que conseguir pasarle la variable $instance
	
	//Getting moderatorID
	$moderatorFacebookID = '108231509585760';
	//echo 'HOLA1'.$moderatorFacebookID.'mal?';
	if (!empty($moderatorFacebookID)) {
		echo '<meta property="fb:admins" content="'.$moderatorFacebookID.'"/>';
		//echo 'HOLA2';
	}
}
add_action('wp_head', 'moderator');
?>