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
		
		echo $currentUrlWithFeed;
	}

	public static function getCurrentUrlWithFeed() {
		return 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'].'feed';
	}
}
?>