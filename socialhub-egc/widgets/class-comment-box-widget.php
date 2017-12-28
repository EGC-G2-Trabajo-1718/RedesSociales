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
		/** 
		* A continuación explico para qué vale cada párrafo:
		* Uso el SDK de Facebook
		* Caja de comentarios
		* Para añadir cuentas de facebook de moderadores (se pueden añadir tantas como quieras, el primero es mi ID)
		*/
		echo 
			'<div id="fb-root"></div>
		
			<div class="fb-comments" data-href="http://localhost:50000/" data-width="100%" data-numposts="5" data-order-by="reverse_time"></div>
		
			<meta property="fb:admins" content="{100000851242004}"/>
			<meta property="fb:admins" content="{YOUR_FACEBOOK_USER_ID_2}"/>';
		
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
}
?>