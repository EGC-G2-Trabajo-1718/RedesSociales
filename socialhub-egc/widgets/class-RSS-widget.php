<?php
/**
 * <Classname>_Widget
 *
 * <Description>.
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
							'RSS button by EGC',
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
		return 'Allow the creation of RSS content from web.';
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
		
		$html .= '<div class="egc-rss-container">';
		$html .= '<div><a class="RSS-button" href='.$currentUrlWithFeed.' data-size="large"><i class="fa fa-rss-square" aria-hidden="true"></i> RSS</a></div>';
		$html .= '</div>';

		$html .= '<div class="egc-feedly-container">';
		$html .= '<div><a href="https://feedly.com/i/subscription/feed/'.$currentUrlWithFeed.'">';
		$html .= '<img id="feedlyFollow" src="http://s3.feedly.com/img/follows/feedly-follow-circle-flat-green_2x.png" alt="follow us in feedly" width="28" height="28"> Feedly</a></div>';
		$html .= '</div>';

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
		// Output admin widget options form
	}

	public static function getCurrentUrlWithFeed() {
		return 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']."feed";
	}
}
?>
