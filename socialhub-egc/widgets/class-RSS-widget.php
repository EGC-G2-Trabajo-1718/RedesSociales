<?php
/**
 * RSS_Widget
 *
 * Allow the creation of buttons for RSS, Feedly and Flipboard.
 *
 * @see WP_Widget
 */
class RSS_Widget extends WP_Widget {
	const BASE_ID = 'rss-button-egc';

	/**
	 * Register widget with WordPress
	 *
	 */
	public function __construct() {
		// Instantiate the parent object
		parent::__construct(static::getBaseID(),
							'RSS, Feedly and Flipboard buttons by EGC',
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
		return 'Allow the creation of buttons for RSS, Feedly and Flipboard.';
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
		$currentUrlWithFeed = static::getCurrentUrlWithFeed();

		//Getting configuration values
		$rss = esc_attr($instance['rss']);
		$feedly = esc_attr($instance['feedly']);
		$flipboard = esc_attr($instance['flipboard']);
		$activation = "yes";

		$html = '';

		//Both activated
		if (strcasecmp($rss, $activation) === 0) {
			$html .= '<div class="egc-rss-container">';
			$html .= '<div><a class="RSS-button" href='.$currentUrlWithFeed.' data-size="large" target="_blank"><i class="fa fa-rss-square" aria-hidden="true"></i> RSS</a></div>';
			$html .= '</div>';
		}

		if (strcasecmp($feedly, $activation) === 0){
			$html .= '<div class="egc-feedly-container">';
			$html .= '<div><a href="https://feedly.com/i/subscription/feed/'.$currentUrlWithFeed.'" target="_blank">';
			$html .= '<img id="feedlyFollow" src="http://s3.feedly.com/img/follows/feedly-follow-circle-flat-green_2x.png" alt="follow us in feedly" width="28" height="28"> Feedly</a></div>';
			$html .= '</div>';
		}

		if (strcasecmp($flipboard, $activation) === 0) {
			$html .= '<div class="egc-flipboard-container">';
			$html .= '<div><a href="https://flipboard.com/@EGC1718" target="_blank">';
			$html .= '<img id="flipboardFollow" src="http://cdn.flipboard.com/badges/flipboard_mrrw.png" alt="follow us in Flipboard" width="28" height="28"> Flipboard</a></div>';
			$html .= '</div>';

		}

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
	    $instance['rss'] = static::isActivated(strip_tags($new_instance['rss']));
	    $instance['feedly'] = static::isActivated(strip_tags($new_instance['feedly']));
	    $instance['flipboard'] = static::isActivated(strip_tags($new_instance['flipboard']));
    
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
		//Getting configuration values
		$rss = esc_attr($instance['rss']);
		$feedly = esc_attr($instance['feedly']);
		$flipboard = esc_attr($instance['flipboard']);
		
		?> 
		
			<strong>RSS button</strong>
			<br/><span id="info">Enter "yes" for enable RSS button:</span>
			<p>
				<label for="<?php echo $this->get_field_id('rss'); ?>">
					<input class="widefat" id="<?php echo $this->get_field_id('rss'); ?>" name="<?php echo $this->get_field_name('rss'); ?>" type="text" value="<?php echo $rss; ?>" />
				</label>
			</p>
			<strong>Feedly button</strong>
			<br/><span id="info">Enter "yes" for enable Feedly button:</span>
			<p>
				<label for="<?php echo $this->get_field_id('feedly'); ?>">
					<input class="widefat" id="<?php echo $this->get_field_id('feedly'); ?>" name="<?php echo $this->get_field_name('feedly'); ?>" type="text" value="<?php echo $feedly; ?>" />
				</label>
			</p>
			<strong>Flipboard button</strong>
			<br/><span id="info">Enter "yes" for enable Flipboard button:</span>
			<p>
				<label for="<?php echo $this->get_field_id('flipboard'); ?>">
					<input class="widefat" id="<?php echo $this->get_field_id('flipboard'); ?>" name="<?php echo $this->get_field_name('flipboard'); ?>" type="text" value="<?php echo $flipboard; ?>" />
				</label>
			</p>
		<?php
	}

	public static function getCurrentUrlWithFeed() {
		return 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']."feed";
	}

	public static function isActivated($activation){

		$result;
		if ($activation != "yes") {
			$result = "";
		}

		else {
			$result = "yes";
		}

		return $result;
	}
}
?>
